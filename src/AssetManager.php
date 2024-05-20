<?php
namespace Federation\UI;

class AssetManager
{
    const MANIFEST_CACHE_KEY = "federation:ui:manifest";
    private array $manifest = [];
    public function __construct(private string $cdnUrl)
    {
        $this->cdnUrl = rtrim($this->cdnUrl, "/");
        $this->loadManifest();
    }

    public function getStyleSheetUrl(): string
    {
        return $this->getUrl('resources/scss/app.scss');
    }
    public function getScriptUrl(): string
    {
        return $this->getUrl('resources/js/app.js');
    }

    public function getUrl(string $file)
    {
        if (!array_key_exists($file, $this->manifest)) {
            throw new \RuntimeException("could not find file [$file] on the manifest");
        }
        $path = $this->manifest[$file]['file'];
        return "{$this->cdnUrl}/build/$path";
    }

    public function getManifestUrl()
    {
        return "{$this->cdnUrl}/build/manifest.json";
    }

    public function loadManifest(): array
    {
        $manifest = null;
        if (\Cache::has(self::MANIFEST_CACHE_KEY)) {
            $manifestString = \Cache::get(self::MANIFEST_CACHE_KEY);
            $manifest = json_decode($manifestString, true);
            if (json_last_error() == 0 && is_array($manifest)) {
                $this->manifest = $manifest;
                return $manifest;
            } else {
                \Cache::delete(self::MANIFEST_CACHE_KEY);
            }
        }

        $manifestString = file_get_contents($this->getManifestUrl());
        $manifest = json_decode($manifestString, true);
        if (json_last_error() == 0 && is_array($manifest)) {
            \Cache::rememberForever(self::MANIFEST_CACHE_KEY, fn() => $manifestString);
            $this->manifest = $manifest;
            return $manifest;
        }
        throw new \RuntimeException(sprintf('Failed to read manifest from CDN: %s', json_last_error_msg()));
    }

}
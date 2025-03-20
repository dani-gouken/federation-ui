<?php
namespace Federation\UI;

class ViteAssetManager implements AssetManagerContract
{
    public function getUrl(string $file): string
    {
        return "http://[::1]:5173/$file";
    }

}
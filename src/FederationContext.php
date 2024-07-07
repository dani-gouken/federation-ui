<?php
namespace Federation\UI;

use Federation\UI\Concerns\ManageDashboard;
use Federation\UI\Concerns\ManagePageBody;
use Federation\UI\Concerns\ManagePageHead;
use Illuminate\Support\Collection;

class FederationContext
{
    use ManagePageHead, ManagePageBody, ManageDashboard;
    private static ?FederationContext $instance = null;
    private Collection $context;

    public function __construct(
        array $data = [],
    ) {
        $this->context = collect($data);
    }

    public static function getInstance(): FederationContext
    {
        if (self::$instance == null) {
            self::$instance = new FederationContext();
        }

        return self::$instance;
    }
    public function has(string $key): bool
    {
        return $this->context->has($key);
    }

    public function get(string $key, $default = null): int|string|bool|null
    {
        return $this->context->get($key, $default);
    }

    public function set(string $key, int|string|bool|null $value): static
    {
        $this->context = $this->context->put($key, $value);
        return $this;
    }
    public function with(string $key, int|string|bool|null $value): static
    {
        return $this->set($key, $value);
    }
}
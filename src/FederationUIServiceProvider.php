<?php
namespace Federation\UI;

use Federation\UI\Components\DataTable\DataTable;
use Federation\UI\Console\ServeCommand;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;

class FederationUIServiceProvider extends ServiceProvider
{

    public function register()
    {
        $this->app->bind(
            AssetManagerContract::class,
            fn() => new ManifestAssetManager(
                config('federation_ui.cdn.url')
            )
        );
        $this->app->singleton(
            FederationContext::class,
            fn() => FederationContext::getInstance()
                ->set("app.name", config('app.name', ''))
        );
    }

    public function boot()
    {
        Livewire::component('data-table', DataTable::class);
        Blade::directive('federationStyle', function (string $expression) {
            return "<link rel='stylesheet' href='<?php echo app(Federation\UI\AssetManagerContract::class)->getUrl('resources/scss/app.scss') ?>'>";
        });

        Blade::directive('federationScript', function (string $expression) {
            return "<script type='module' src='<?php echo app(Federation\UI\AssetManagerContract::class)->getUrl('resources/js/app.js') ?>'></script>";
        });


        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'f');
        Blade::componentNamespace('Federation\\UI\\Components', 'f');
        $this->mergeConfigFrom(
            __DIR__ . '/../config/federation_ui.php',
            'federation_ui'
        );


        if ($this->app->runningInConsole()) {
            $this->commands([
                ServeCommand::class,
            ]);
        }

    }

}
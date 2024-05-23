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
            AssetManager::class,
            fn() => new AssetManager(
                config('federation_ui.cdn.url')
            )
        );
    }

    public function boot()
    {
        Livewire::component('data-table', DataTable::class);
        Blade::directive('federationStyle', function (string $expression) {
            return "<link rel='stylesheet' href='<?php echo app(Federation\UI\AssetManager::class)->getStyleSheetUrl() ?>'>";
        });

        Blade::directive('federationScript', function (string $expression) {
            return "<script src='<?php echo app(Federation\UI\AssetManager::class)->getScriptUrl() ?>'></script>";
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
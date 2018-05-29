<?php

namespace Bdwey\Specs;

use Illuminate\Support\ServiceProvider;
use Illuminate\Database\Eloquent\Relations\Relation;
use Bdwey\Specs\Traits\Assistant;

class SpecsServiceProvider extends ServiceProvider
{
    use Assistant;
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        if (!$this->app->routesAreCached()) {
            require __DIR__.'/routes.php';
        }
        $this->loadMigrationsFrom(__DIR__.'/Database/Migrations');
        $this->loadViewsFrom(__DIR__.'/Resources/views', 'Specs');
        $this->loadTranslationsFrom(__DIR__.'/Resources/lang', 'Specs');
        $this->publishes([
            __dir__ . '/Database/Seeds' => database_path('seeds')
        ],'specs.seeds');
        // Relation::morphMap($this->getMorphMap());
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        // $this->app->make('Bdwey\Specs\Http\SpecsController');
    }
}

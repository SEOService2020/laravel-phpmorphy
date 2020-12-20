<?php

namespace SEOService2020\Morphy;

use Illuminate\Support\ServiceProvider;


class MorphyServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__ . '/../config/config.php' => config_path('morphy.php')
            ], 'config');
        }
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/config.php', 'morphy');

        $this->app->bind('morphy', function () {
            return new Morphy(
                config('morphy.language'),
                config('morphy.options'),
                config('morphy.dicts_path')
            );
        });
    }
}

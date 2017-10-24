<?php

namespace RebirthTobi\QubeRbac;

use Illuminate\Support\ServiceProvider;

class QubeRbacServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadRoutesFrom(__DIR__.'/routes.php');
        $this->loadMigrationsFrom(__DIR__.'/database/migrations');
        $this->loadViewsFrom(__DIR__.'/views', 'quberbac');

        $this->publishes([
            __DIR__.'../config/quberbac.php' => config_path('quberbac.php'),
        ], 'config');

        $this->publishes([
            __DIR__.'/views' => resource_path('views/vendor/quberbac'),
        ]);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('quberbac', function() {
            return new Demo;
        });
    }
}
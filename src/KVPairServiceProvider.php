<?php

namespace sachingk\kvpair;

use Illuminate\Support\ServiceProvider;

class KVPairServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadTranslationsFrom( __DIR__.'/Lang', 'kvpair');

        $this->publishes([
            __DIR__.'/Config/kvpair.php' => config_path('kvpair.php'),
        ], 'config');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
       // include __DIR__.'/routes.php';


        $this->mergeConfigFrom( __DIR__.'/Config/kvpair.php', 'kvpair');



        $this->app->singleton('kvpair', function ($app) {
            return new kvpair();
        });

    }
}

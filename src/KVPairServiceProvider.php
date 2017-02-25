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

        $this->loadMigrationsFrom(__DIR__.'/database/migration');

        $this->publishes([
            __DIR__.'/Config/kvpair.php' => config_path('kvpair.php'),
        ], 'config');


        $this->publishes([
            __DIR__.'/database/migration'=> database_path('migrations')
        ], 'migrations');


        $this->publishes([
            __DIR__.'/Lang'=> base_path('resources/lang')
        ], 'lang');
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

        $this->app->singleton('KVPair', function ($app) {
            return new KVPair();
        });

    }
}

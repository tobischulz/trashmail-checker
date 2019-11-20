<?php

namespace TobiSchulz\TrashmailChecker;

use Illuminate\Support\ServiceProvider;

class TrashmailCheckerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('trashmailchecker', function () {
            return new TrashmailChecker;
        });

        $this->publishes([
            __DIR__.'/../database/migrations/' => database_path('migrations')
        ], 'migrations');

        $this->publishes([
            __DIR__.'/../database/seeds/' => database_path('seeds')
        ], 'seeds');

        $this->publishes([
            __DIR__.'/../config/trashmailchecker.php' => config_path('trashmailchecker.php'),
        ], 'config');
        
        $this->publishes([
            __DIR__.'/../resources/lang' => resource_path('lang/vendor/trashmailchecker'),
        ], 'translations');
    }
    
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadTranslationsFrom(__DIR__.'/../resources/lang', 'trashmailchecker');

        $this->publishes([
            __DIR__.'/../resources/lang' => resource_path('lang/vendor/trashmailchecker'),
        ]);
    }

    /**
    * Get the services provided by the provider.
    *
    * @return array
    */
    public function provides()
    {
        return [
            'trashmailchecker'
        ];
    }
}

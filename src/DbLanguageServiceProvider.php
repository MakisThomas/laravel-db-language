<?php

namespace Makth\DbLanguage;

use Illuminate\Support\ServiceProvider;
use Makth\DbLanguage\Console\Commands\AddDbLanguageFields;
use Makth\DbLanguage\Console\Commands\RemoveDbLanguageFields;

class DbLanguageServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                AddDbLanguageFields::class,
                RemoveDbLanguageFields::class
            ]);
        }

        $this->publishes([
        __DIR__.'/config.php' => config_path('lang.php')
        ], 'config');

        $this->publishes([
        __DIR__.'/vendor' => public_path('vendor')
        ], 'public');

        $this->loadViewsFrom(__DIR__.'/views/fields', 'fields');
        $this->loadViewsFrom(__DIR__.'/views', 'lang');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('lang', function () {
            return new \Makth\DbLanguage\Lang;
        });

        $this->mergeConfigFrom(
            __DIR__ . '/config.php', 'lang'
        );
    }
}

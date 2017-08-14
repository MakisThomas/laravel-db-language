<?php

namespace Makth\DbLanguage;

use Illuminate\Support\ServiceProvider;
use Makth\DbLanguage\Console\Commands\AddDbLanguageFields;

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
                AddDbLanguageFields::class
            ]);
        }
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}

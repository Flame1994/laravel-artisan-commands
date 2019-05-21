<?php

namespace Rhaarhoff\LaravelArtisanCommands;

use Illuminate\Support\ServiceProvider;

class CommandServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        // used to bind any classes or functionality into the app container
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // used to boot any routes, event listeners, or any other functionality you want to add to your package
        if ($this->app->runningInConsole()) {
            $this->commands([
                Console\Services\Create::class,
            ]);
        }
    }
}

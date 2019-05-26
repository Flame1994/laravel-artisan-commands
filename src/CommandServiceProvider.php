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
        // Used to bind any classes or functionality into the app container.
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // Used to boot any routes, event listeners, or any other functionality you want to add to your package.
        if ($this->app->runningInConsole()) {
            $this->commands([
                Console\Repositories\CreateRepository::class,
                Console\Services\CreateService::class,
                Console\Layers\CreateLayer::class,
            ]);
        }
    }
}

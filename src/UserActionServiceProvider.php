<?php

namespace RafflesArgentina\UserAction;

use Illuminate\Support\ServiceProvider;

use RafflesArgentina\UserAction\Providers\RouteServiceProvider;

class UserActionServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([__DIR__.'/Config/user-action.php' => config_path('user-action.php')], 'user-action');

        $this->publishes([__DIR__.'/Database/Migrations' => database_path('migrations')], 'user-action');

        $this->publishes([__DIR__.'/Resources/Views' => resource_path('views/vendor/user-action')], 'user-action');

        //$this->publishes([__DIR__.'/../assets/js/user-action.js' => public_path('js/user-action.js')], 'user-action');

        $this->loadViewsFrom(__DIR__.'/Resources/Views', 'user-action');
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/Config/user-action.php', 'user-action');

        $this->app->register(RouteServiceProvider::class);
    }
}

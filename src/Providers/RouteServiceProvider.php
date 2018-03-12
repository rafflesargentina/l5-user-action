<?php

namespace RafflesArgentina\UserAction\Providers;

use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Route;

use RafflesArgentina\UserAction\Traits\PackageSettings;

class RouteServiceProvider extends ServiceProvider
{
    use PackageSettings;

    /**
     * Create a new RouteServiceProvider instance.
     *
     * @return void
     */
    public function __construct($app)
    {
        $this->alias = config($this->package.'.alias');
        $this->module = config($this->package.'.module');
        $this->prefix = config($this->package.'.prefix');

        parent::__construct($app);
    }

    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'RafflesArgentina\UserAction\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        //

        parent::boot();
    }

    /**
     * Define the routes for the module.
     *
     * @return void
     */
    public function map()
    {
        $this->mapWebRoutes();

        $this->mapApiRoutes();

        //
    }

    /**
     * Define the "web" routes for the module.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        Route::group([
            'middleware' => config($this->package.'.web_routes_middleware') ?: 'web',
            'namespace'  => $this->namespace,
            'prefix' => $this->prefix,
        ], function ($router) {
            require __DIR__.'/../Routes/web.php';
        });
    }

    /**
     * Define the "api" routes for the module.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::group([
            'middleware' => config($this->package.'.api_route_middleware') ?: 'api',
            'namespace'  => $this->namespace,
            'prefix'     => 'api',
        ], function ($router) {
            require __DIR__.'/../Routes/api.php';
        });
    }
}

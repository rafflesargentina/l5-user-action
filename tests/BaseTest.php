<?php

namespace RafflesArgentina\UserAction;

use Illuminate\Foundation\Testing\WithoutMiddleware;

trait BaseTest
{
    use WithoutMiddleware;

    /**
     * The name of the package.
     *
     * @var string $package
     */
    public $package = 'user-action';

    public $user_model = \RafflesArgentina\UserAction\Models\User::class;

    public $properties2Check = [
        'filters',
        'package',
        'sorters',
        'presenter',
        'date_format',
    ];

    /**
     * Setup the test environment.
     */
    public function setUp()
    {
        parent::setUp();

        $this->loadMigrationsFrom(__DIR__.'/database/migrations');

        $this->withFactories(__DIR__.'/factories');
    }

    /**
     * Define environment setup.
     *
     * @param  \Illuminate\Foundation\Application  $app
     * @return void
     */
    protected function getEnvironmentSetUp($app)
    {
        // Setup default database to use sqlite :memory:
        $app['config']->set('database.default', 'testbench');
        $app['config']->set('database.connections.testbench', [
            'driver'   => 'sqlite',
            'database' => ':memory:',
            'prefix'   => '',
        ]);

        $app['config']->set($this->package.'.user_model', \RafflesArgentina\UserAction\Models\User::class);
        $app['config']->set($this->package.'.web_routes_middleware', \Illuminate\View\Middleware\ShareErrorsFromSession::class);
    }

    //protected function getPackageAliases($app)
    //{
        //return [
        //];
    //}

    /**
     * Get package providers.  At a minimum this is the package being tested, but also
     * would include packages upon which our package depends, e.g. Cartalyst/Sentry
     * In a normal app environment these would be added to the 'providers' array in
     * the config/app.php file.
     *
     * @param  \Illuminate\Foundation\Application  $app
     *
     * @return array
     */
    protected function getPackageProviders($app)
    {
        return [
            // your package service provider,
            \Orchestra\Database\ConsoleServiceProvider::class,
            \RafflesArgentina\UserAction\UserActionServiceProvider::class,
        ];
    }
}

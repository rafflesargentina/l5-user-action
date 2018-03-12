<?php

namespace RafflesArgentina\UserAction\Http\Controllers;

use RafflesArgentina\ResourceController\ResourceController;

class PackageResourceController extends ResourceController
{
    /**
     * The name of the package.
     *
     * @var string $package
     */
    protected $package = 'user-action';

    /**
     * Create a new PackageResourceController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->alias = config($this->package.'.alias');
        $this->theme = config($this->package.'.theme');
        $this->module = config($this->package.'.module');
        $this->prefix = config($this->package.'.prefix');

        parent::__construct();
    }
}

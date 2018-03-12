<?php

namespace RafflesArgentina\UserAction\Http\Controllers;

use RafflesArgentina\UserAction\Http\Requests\UserActionRequest;
use RafflesArgentina\UserAction\Repositories\UserActionRepository;

class UserActionsController extends PackageResourceController
{
    /**
     * Create a new UserActionsController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->repository = config($this->package.'.user-action.repository') ?: UserActionRepository::class;
        //$this->formRequest = config($this->package.'.user-action.form_request') ?: UserActionRequest::class;
        $this->resourceName = config($this->package.'.user-action.resource_name') ?: 'acciones-de-usuario';

        parent::__construct();
    }
}

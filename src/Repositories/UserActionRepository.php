<?php

namespace RafflesArgentina\UserAction\Repositories;

use Caffeinated\Repository\Repositories\EloquentRepository;

use RafflesArgentina\UserAction\Models\UserAction;

class UserActionRepository extends EloquentRepository
{
    public $model;

    protected $tag = ['UserAction'];

    /**
     * Create a new UserRepository object.
     *
     * @return void
     */
    public function __construct()
    {
        $this->model = config('user-action.user.model') ?: UserAction::class;

        parent::__construct();
    }
}

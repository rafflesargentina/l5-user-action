<?php

namespace RafflesArgentina\UserAction;

use Orchestra\Testbench\TestCase;
use RafflesArgentina\TestTraits\ModelTest;

use RafflesArgentina\UserAction\Models\UserAction;
use RafflesArgentina\UserAction\Http\Requests\UserActionRequest;

class UserActionModelTest extends TestCase
{
    use BaseTest, ModelTest;

    protected $model = UserAction::class;

    protected $formRequest;

    public function getValidationRules()
    {
        return [];
    }

    function testRecordBelongsToUser()
    {
        $userAction = factory(UserAction::class)->create();

        $this->assertTrue($userAction->user instanceof \RafflesArgentina\UserAction\Models\User);
    }
}

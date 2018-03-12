<?php

namespace RafflesArgentina\UserAction;

use Orchestra\Testbench\TestCase;
use RafflesArgentina\TestTraits\ResourceRoutesTest;

use RafflesArgentina\UserAction\Models\UserAction;

class UserActionRoutes extends TestCase
{
    use BaseTest, ResourceRoutesTest;

    protected $model = UserAction::class;

    protected $resourceName = 'acciones-de-usuario';

    function testCreateRoute()
    {
        $this->get("/{$this->resourceName}/create")
             ->assertStatus(404);

        $this->json("GET", "/{$this->resourceName}/create")
             ->assertStatus(404);
    }

    function testStoreRoute()
    {
        $this->post("/{$this->resourceName}", [])
             ->assertStatus(405);

        $this->json("POST", "/{$this->resourceName}", [])
             ->assertStatus(405);
    }

    function testEditRoute()
    {
        $this->get("/{$this->resourceName}/edit")
             ->assertStatus(404);

        $this->json("GET", "/{$this->resourceName}/edit")
             ->assertStatus(404);
    }

    function testUpdateRoute()
    {
        $this->put("/{$this->resourceName}", [])
             ->assertStatus(405);

        $this->json("PUT", "/{$this->resourceName}", [])
             ->assertStatus(405);
    }

    function testDestroyRoute()
    {
        $this->delete("/{$this->resourceName}")
             ->assertStatus(405);

        $this->json("PUT", "/{$this->resourceName}")
             ->assertStatus(405);
    }
}

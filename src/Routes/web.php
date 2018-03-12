<?php

Route::middleware(['auth'])->group(function() {
    Route::resource((config($this->package.'.user-action.resource_name') ?: 'acciones-de-usuario'), 'UserActionsController', ['as' => $this->alias, 'only' => ['index','show']]);
});

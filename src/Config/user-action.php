<?php

return [
    /* Routing */
    'alias' => null,
    'theme' => null,
    'module' => 'user-action',
    'prefix' => null,
    'api_routes_middleware' => null,
    'web_routes_middleware' => null,

    /* UserAction model properties */
    'user-action' => [
        'model' => null,
        'filters' => null,
        'sorters' => null,
        'presenter' => null,
        'connection' => null,
        'date_format' => 'd/m/Y',
        'form_request' => null,
        'resource_name' => 'acciones-de-usuario',
        'route_key_name' => 'id',
    ],
];

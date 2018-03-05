<?php

return [
    /* Logging */
    'log_events_to_db' => true,
    'log_events_to_file' => true,

    /* UserAction model properties */
    'user-action' => [
        'model' => null,
        'filters' => null,
        'sorters' => null,
        'presenter' => null,
        'connection' => null,
        'date_format' => 'd/m/Y',
        'form_request' => null,
        'resource_name' => 'auditoria',
        'route_key_name' => 'id',
    ],
];

<?php

return [
    /*
     *  The database connection and user_id type to use for the tables.
     */
    'database' => [
        'connection' => env('BTAG_DB_CONNECTION', env('DB_CONNECTION', 'mysql')),
        'uuid' => false,
        'taggable_uuid' => false,
    ],


    /*
     *  The route prefix and middleware to use for the routes.
     */
    'routes' => [
        'api' => [
            'enabled' => env('BTAG_API_ENABLED', false),
            'prefix' => env('BTAG_API_PREFIX', 'api'),
            'name' => env('BTAG_API_NAME', 'api.tags.'),
            'middleware' => ['api'],
        ],
        'web' => [
            'enabled' => env('BTAG_WEB_ENABLED', false),
            'prefix' => env('BTAG_WEB_PREFIX', 'web'),
            'name' => env('BTAG_WEB_NAME', 'tags.'),
            'middleware' => ['web'],
        ],
    ],
];

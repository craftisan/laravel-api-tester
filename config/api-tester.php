<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Enable api tester
    |--------------------------------------------------------------------------
    |
    | You can turn on and off the tester on will. Or maybe bind it to
    | some env value.
    |
    */

    'enabled' => env('API_TESTER', false),

    /*
    |--------------------------------------------------------------------------
    | Default route
    |--------------------------------------------------------------------------
    |
    | Define the route for api router.
    | http://your-site.com/{route}
    |
    */

    'route' => env('API_TESTER_ROUTE', 'api-tester'),

    /*
    |--------------------------------------------------------------------------
    | HTTP/HTTPS
    |--------------------------------------------------------------------------
    |
    | Set if the api tester will be served over https url scheme
    */
    'https' => env('API_TESTER_HTTPS', true),

    /*
    |--------------------------------------------------------------------------
    | Middleware
    |--------------------------------------------------------------------------
    |
    | Define list of middleware, that should be used for api-tester.
    | This allows automatic CRSF token handling.
    | You can also use middleware groups, such as 'web' (Laravel 5.2+).
    |
    */

    'middleware' => [
        Illuminate\Cookie\Middleware\EncryptCookies::class,
        Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
        Illuminate\Session\Middleware\StartSession::class,
        Illuminate\View\Middleware\ShareErrorsFromSession::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Additional route meta information
    |--------------------------------------------------------------------------
    | Displays additional route information. Such as request rules and comments.
    |
    | !WARNING!
    | This sometimes causes fatal errors, rendering api tester unusable.
    | Set to false if that's your case.
    */

    'route_meta' => true,

    /*
    |--------------------------------------------------------------------------
    | Request analysis
    |--------------------------------------------------------------------------
    | Display request rules..
    |
    | !WARNING!
    | This sometimes causes fatal errors, rendering api tester unusable.
    | Set to false if that's your case.
    */

    'request_rules' => true,

    /*
    |--------------------------------------------------------------------------
    | Filter routes
    |--------------------------------------------------------------------------
    | All your routes will be filtered via given patterns. Both include and
    | exclude are always applied. You can also use regex when needed.
    |
    | ## Examples
    |
    | ### Include all
    | 'include' => []
    |
    | ### Include some routes
    | 'include' => [
    |      'api/users',
    |      'api/sales',
    |      // ...
    |  ]
    |
    | ### Include/exclude advanced syntax
    | 'include' => [
    |      [
    |         'path' => 'api/v(1|2|3)/.*',
    |         'name' => '.*',
    |         'method' => '(GET|POST|PUT|PATCH|DELETE)'
    |      ],
    |      // ...
    |  ]
    |
    | ### Include all except 'api/users'
    | 'include' => [],
    | 'exclude' => ['api/users'],
    |
    */

    'include' => '.*',
    'exclude' => [
        env('API_TESTER_ROUTE', 'api-tester'),
    ],

    /*
    |--------------------------------------------------------------------------
    | Repositories
    |--------------------------------------------------------------------------
    |
    | Specify list of Route Repositories that to be used for providing routes.
    |
    */

    'route_repositories' => [
        Craftisan\ApiTester\Repositories\RouteLaravelRepository::class,
        //Craftisan\ApiTester\Repositories\RouteDingoRepository::class,
    ],

    /*
    |--------------------------------------------------------------------------
    | Request Repository
    |--------------------------------------------------------------------------
    | Define class of request repository.
    |
    */

    'request_repository' => Craftisan\ApiTester\Repositories\RequestRepository::class,

    /*
    |--------------------------------------------------------------------------
    | Craftisan\ApiTester\Repositories\RequestRepository configuration
    |--------------------------------------------------------------------------
    | This config matters only when using Craftisan\ApiTester\Repositories\RequestRepository
    | or similar implementations.
    |
    */

    'storage_driver' => env('API_TESTER_STORAGE', 'file'),

    'storage_drivers' => [
        'file' => [
            'class' => Craftisan\ApiTester\Storages\JsonStorage::class,
            'options' => [
                'path' => storage_path('api-tester/requests.db'),
            ],
        ],
        'firebase' => [
            'class' => Craftisan\ApiTester\Storages\FireBaseStorage::class,
            'options' => [
                'base' => env('API_TESTER_FIREBASE_ADDRESS', 'https://example.firebaseio.com/api-tester/'),
                // sample value https://example.firebaseio.com/api-tester/
            ],
            'token' => [
                'secret' => env('API_TESTER_FIREBASE_SECRET', ''),
                'options' => ['admin' => true],
                'data' => [],
            ],
        ],
    ],
];

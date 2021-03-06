<?php

$router = app('router');

// Api-tester base route. This is entry point for frontend-SPA.
$router->get('/', [
    'as' => 'home',
    'uses' => 'HomeController@index',
]);

// Fetch all Laravel routes.
$router->post('routes/index', 'RouteController@index');

$router->post('requests/index', 'RequestController@index');
$router->post('requests/store', 'RequestController@store');
$router->post('requests/update', 'RequestController@update');
$router->post('requests/destroy', 'RequestController@destroy');

// We won't publish library's assets.
// Instead we'll pass them via app which is slower but fine for development.
$router->group(['prefix' => 'assets'], function ($router) {

    $filePattern = '^([a-z0-9_\-\.]+)$';

    $router->get('fonts/{_file}', [
        'as' => 'font',
        'uses' => 'AssetsController@font',
    ])->where('_file', $filePattern);

    $router->get('img/{_file}', [
        'as' => 'image',
        'uses' => 'AssetsController@image',
    ])->where('_file', $filePattern);

    $router->get('{_file}', [
        'as' => 'file',
        'uses' => 'AssetsController@index',
    ])->where('_file', $filePattern);
});




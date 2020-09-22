<?php

namespace Craftisan\ApiTester;

use Craftisan\ApiTester\Providers\RepositoryServiceProvider;
use Craftisan\ApiTester\Providers\RouteServiceProvider;
use Craftisan\ApiTester\Providers\StorageServiceProvide;
use Craftisan\ApiTester\Providers\ViewServiceProvider;

class ServiceProvider extends \Illuminate\Support\ServiceProvider
{

    public function register()
    {
        if (!defined('API_TESTER_PATH')) {
            define('API_TESTER_PATH', realpath(__DIR__ . '/../'));
        }

        $this->mergeConfigFrom(API_TESTER_PATH . '/config/api-tester.php', 'api-tester');

        // If Api Tester is disabled, we won't run any service providers.
        if (!$this->app['config']['api-tester.enabled']) {
            return;
        }
        $this->app->register(RouteServiceProvider::class);
        $this->app->register(RepositoryServiceProvider::class);
        $this->app->register(StorageServiceProvide::class);
        $this->app->register(ViewServiceProvider::class);
    }

    public function boot()
    {
        $this->publishes([API_TESTER_PATH . '/config/api-tester.php' => config_path('api-tester.php')], 'config');
    }
}

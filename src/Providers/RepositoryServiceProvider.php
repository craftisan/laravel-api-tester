<?php

namespace Craftisan\ApiTester\Providers;

use Craftisan\ApiTester\Collections\RouteCollection;
use Craftisan\ApiTester\Contracts\RequestRepositoryInterface;
use Craftisan\ApiTester\Contracts\RouteRepositoryInterface;
use Craftisan\ApiTester\Repositories\RouteRepository;
use Illuminate\Contracts\Container\Container;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{

    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(RouteRepositoryInterface::class, function (Container $app) {
            $repositories = [];
            foreach (config('api-tester.route_repositories') as $repository) {
                $repositories[] = $app->make($repository);
            }

            $routeCollection = $app->make(RouteCollection::class);

            return new RouteRepository($routeCollection, $repositories);
        });

        $this->app->singleton(
            RequestRepositoryInterface::class,
            config('api-tester.request_repository')
        );
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return [
            RouteRepositoryInterface::class,
            RequestRepositoryInterface::class,
        ];
    }
}
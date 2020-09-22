<?php

namespace Craftisan\ApiTester\Repositories;

use Craftisan\ApiTester\Collections\RouteCollection;
use Craftisan\ApiTester\Contracts\RouteRepositoryInterface;
use Craftisan\ApiTester\Entities\RouteInfo;
use Illuminate\Routing\Router;

class RouteLaravelRepository implements RouteRepositoryInterface
{

    /**
     * @type \Craftisan\ApiTester\Collections\RouteCollection
     */
    protected $routes;

    public function __construct(RouteCollection $collection, Router $router)
    {
        $this->routes = $collection;

        foreach ($router->getRoutes() as $route) {
            $routeInfo = (new RouteInfo($route, ['router' => 'Laravel']))->toArray();
            $this->routes->push($routeInfo);
        }
    }

    /**
     * @param array $match
     * @param array $except
     *
     * @return \Craftisan\ApiTester\Collections\RouteCollection
     */
    public function get($match = [], $except = [])
    {
        return $this->routes->filterMatch($match)
            ->filterExcept($except)
            ->values();
    }
}

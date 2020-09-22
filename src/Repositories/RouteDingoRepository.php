<?php

namespace Craftisan\ApiTester\Repositories;

use Craftisan\ApiTester\Collections\RouteCollection;
use Craftisan\ApiTester\Contracts\RouteRepositoryInterface;
use Craftisan\ApiTester\Entities\RouteInfo;
use Dingo\Api\Routing\Router;
use Illuminate\Contracts\Config\Repository as Config;

/**
 * Class RouteDingoRepository
 *
 * @package \Craftisan\ApiTester\Repositories
 */
class RouteDingoRepository implements RouteRepositoryInterface
{

    /**
     * @type \Craftisan\ApiTester\Collections\RouteCollection
     */
    protected $routes;

    public function __construct(RouteCollection $collection, Router $router, Config $config)
    {
        $this->routes = $collection;
        $standardsTree = $config['api.standardsTree'];
        $subtype = $config['api.subtype'];
        $defaultFormat = $config['api.defaultFormat'];

        foreach ($router->getAdapterRoutes() as $versionName => $versionGroup) {
            foreach ($versionGroup as $route) {
                $routeInfo = (new RouteInfo($route, [
                    'router' => 'Dingo',
                    'version' => $versionName,
                    'headers' => [
                        [
                            'key' => 'Accept',
                            'value' => "application/{$standardsTree}.{$subtype}.{$versionName}+{$defaultFormat}",
                        ],
                    ],
                ]))->toArray();
                $this->routes->push($routeInfo);
            }
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

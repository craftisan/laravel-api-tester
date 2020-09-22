<?php

namespace Craftisan\ApiTester\Repositories;

use Craftisan\ApiTester\Collections\RouteCollection;
use Craftisan\ApiTester\Contracts\RouteRepositoryInterface;

/**
 * Class RouteRepository
 *
 * @package \Craftisan\ApiTester\Repositories
 */
class RouteRepository implements RouteRepositoryInterface
{

    /**
     * @type \Craftisan\ApiTester\Contracts\RouteRepositoryInterface[]
     */
    protected $repositories;

    /**
     * @type \Craftisan\ApiTester\Collections\RouteCollection
     */
    protected $routes;

    public function __construct(RouteCollection $routes, $repositories)
    {
        $this->routes = $routes;
        $this->repositories = $repositories;
    }

    /**
     * @param array $match
     * @param array $except
     *
     * @return mixed
     */
    public function get($match = [], $except = [])
    {
        foreach ($this->repositories as $repository) {

            foreach ($repository->get($match, $except) as $route) {
                $this->routes->push($route);
            }
        }

        return $this->routes;
    }
}

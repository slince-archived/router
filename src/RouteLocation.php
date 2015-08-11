<?php
/**
 * slince router library
 * @author Tao <taosikai@yeah.net>
 */
namespace Slince\Router;

class RouteLocation
{

    protected $_route;

    protected $_routes;

    function __construct(RouteInterface $route, RouteCollection $routes)
    {
        $this->_route = $route;
        $this->_routes = $routes;
    }

    function getRoute()
    {
        return $this->_route;
    }
}
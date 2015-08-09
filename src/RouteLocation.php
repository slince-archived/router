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
    
    protected $_level;
    
    function __construct(RouteInterface $route, RouteCollection $routes, $level)
    {
        $this->_route = $route;
        $this->_routes = $routes;
        $this->_level = $level;
    }
    
    function getRoute()
    {
        return $this->_route;
    }
}
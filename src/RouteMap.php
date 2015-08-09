<?php
/**
 * slince router library
 * @author Tao <taosikai@yeah.net>
 */
namespace Slince\Router;

class RouteMap
{
    /**
     * location
     * 
     * @var array
     */
    protected $_locations;
    
    function __construct(array $locations = [])
    {
        $this->_locations = $locations;
    }
    static function create(array $locations = [])
    {
        return new static($locations);
    }
    
    function add(RouteLocation $location)
    {
        $route = $location->getRoute();
        $routeKey = $route->getOption('name');
        if (! $routeKey) {
            $routeKey = spl_object_hash($route);
        }
        $routeKey = $this->getRouteKey($location->getRoute());
        $this->_locations[$routeKey] = $location;
    }
    
    /**
     * 获取route在map上的位置
     * 
     * @param RouteInterface $route
     * @return RouteLocation
     */
    function getLocation(RouteInterface $route)
    {
        $routeKey = $this->getRouteKey($route);
        return isset($this->_locations[$routeKey]) ? $this->_locations[$routeKey] : null;
    }
    
    /**
     * 获取route key
     * @param RouteInterface $route
     * @return string
     */
    function getRouteKey(RouteInterface $route)
    {
        $routeKey = $route->getOption('name');
        if (! $routeKey) {
            $routeKey = spl_object_hash($route);
        }
        return $routeKey;
    }
    function getRouteByName()
    {
        
    }
}
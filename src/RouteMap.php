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
    
    protected static $_instance;
    
    function __construct(array $locations = [])
    {
        $this->_locations = $locations;
    }
    static function newInstance()
    {
        if (! self::$_instance instanceof static) {
            self::$_instance = new static();
        }
        return self::$_instance;
    }
    
    function push(RouteInterface $route, RouteCollection $routes)
    {
        $this->add(new RouteLocation($route, $routes));
    }
    
    function add(RouteLocation $location)
    {
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
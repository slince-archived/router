<?php
/**
 * slince router library
 * @author Tao <taosikai@yeah.net>
 */
namespace Slince\Router;

class RouteStore
{
    
    protected static $_instance;
    
    protected $_names;
    
    protected $_actions;
    
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
    
    function add(RouteInterface $route)
    {
        if ($route->hasOption('name')) {
            $routeKey = $route->getOption('name');
            $this->_names[$routeKey] = $route;
        }
        
        if ($route->hasOption('action')) {
            $action = $route->getOption('action');
            $routeKey = $route->getPrefix() . '/' . $action;
            $this->_actions[$routeKey] = $route;
        }
    }
}
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
    
    static function newInstance()
    {
        if (! self::$_instance instanceof static) {
            self::$_instance = new static();
        }
        return self::$_instance;
    }
    
    function add(RouteInterface $route)
    {
        if ($route->hasParameter('name')) {
            $routeKey = $route->getParameter('name');
            $this->_names[$routeKey] = $route;
        }
        $action = $route->getParameter('action');
        if (is_string($action)) {
            $routeKey = $route->getPrefix() . '/' . $action;
            $this->_actions[$routeKey] = $route;
        }
    }
    
    function getByName($name)
    {
        return isset($this->_names[$name]) ? $this->_names[$name] : null;
    }
    
    function getByAction($action)
    {
        return isset($this->_actions[$action]) ? $this->_actions[$action] : null;
    }
}
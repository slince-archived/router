<?php
/**
 * slince router library
 * @author Tao <taosikai@yeah.net>
 */
namespace Slince\Router;

class RouteStore
{

    /**
     * 当前类实例
     *
     * @var RouteStore
     */
    protected static $_instance;

    /**
     * 按routename存储的route
     *
     * @var array
     */
    protected $_names;

    /**
     * 按route action存储的route
     *
     * @var array
     */
    protected $_actions;

    /**
     * 实例化当前类
     *
     * @return \Slince\Router\RouteStore
     */
    static function newInstance()
    {
        if (! self::$_instance instanceof static) {
            self::$_instance = new static();
        }
        return self::$_instance;
    }

    /**
     * 添加route
     *
     * @param RouteInterface $route            
     */
    function add(RouteInterface $route)
    {
        if ($route->hasParameter('name')) {
            $routeKey = $route->getParameter('name');
            $this->_names[$routeKey] = $route;
        }
        $action = $route->getParameter('action');
        if (! empty($action) && is_string($action)) {
            $routeKey = $route->getPrefix() . '/' . $action;
            $this->_actions[$routeKey] = $route;
        }
    }

    /**
     * 根据route name找到route
     *
     * @param string $name            
     * @return RouteInterface $route
     */
    function getByName($name)
    {
        return isset($this->_names[$name]) ? $this->_names[$name] : null;
    }

    /**
     * 根据route action找到route
     *
     * @param string $action            
     * @return RouteInterface $route
     */
    function getByAction($action)
    {
        $action = '/' . trim($action, '/');
        return isset($this->_actions[$action]) ? $this->_actions[$action] : null;
    }
}
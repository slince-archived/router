<?php
/**
 * slince router library
 * @author Tao <taosikai@yeah.net>
 */
namespace Slince\Router;

class RouteCollection implements \Countable, \IteratorAggregate
{
    
    use RouteCreatorTrait;

    /**
     * route集合
     * 
     * @var array
     */
    protected $_routes = [];

    /**
     * 子集
     *
     * @var array
     */
    protected $_subRoutes = [];

    function __construct(array $routes = [])
    {
        $this->_routes = $routes;
    }

    /**
     * 实例化当前对象
     * 
     * @param arrau $routes            
     * @return \Slince\Router\RouteCollection
     */
    static function create($routes = [])
    {
        return new self($routes);
    }

    /**
     * 添加路由
     *
     * @param RouteInterface $route            
     */
    function add(RouteInterface $route)
    {
        $this->_routes[] = $route;
    }

    /**
     * 添加命名路由
     * 
     * @param string $name            
     * @param RouteInterface $route            
     */
    function addNamedRoute($name, RouteInterface $route)
    {
        $this->_routes[$name] = $route;
    }

    /**
     * 更换路由集合
     * 
     * @param array $routes            
     */
    function replace(array $routes)
    {
        $this->_routes = $routes;
    }

    /**
     * 添加一个子路由集合
     * 
     * @param string $prefix            
     * @param RouteCollection $routes            
     */
    function addSubRoutes($prefix, RouteCollection $routes)
    {
        $this->_subRoutes[$prefix] = $routes;
    }

    /**
     * 是否有前缀
     * 
     * @param string $prefix            
     */
    function hasPrefix($prefix)
    {
        return isset($this->_subRoutes[$prefix]);
    }

    /**
     * 获取某个前缀下的子路由
     * 
     * @param string $prefix            
     * @return RouteCollection
     */
    function getSubRoutes($prefix)
    {
        return isset($this->_subRoutes[$prefix]) ? $this->_subRoutes[$prefix] : null;
    }

    /**
     * (non-PHPdoc)
     * 
     * @see Countable::count()
     */
    function count()
    {
        return count($this->_routes);
    }

    /**
     * (non-PHPdoc)
     * 
     * @see IteratorAggregate::getIterator()
     */
    function getIterator()
    {
        return new \ArrayIterator($this->_routes);
    }
}
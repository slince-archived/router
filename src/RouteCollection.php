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

    /**
     * 父级routes
     *
     * @var RouteCollection
     */
    protected $_parentRoutes;
    
    /**
     * 顶级routes
     *
     * @var RouteCollection
     */
    protected $_topRoutes;

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
        return new static($routes);
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
        $routes->setParentRoutes($this);
        $routes->setTopRoutes($this->getTopRoutes());
        $this->_subRoutes[$prefix] = $routes;
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
     * 设置父级routes
     *
     * @return RouteCollection
     */
    function setParentRoutes(RouteCollection $routes)
    {
        $this->_parentRoutes = $routes;
        return $this;
    }
    /**
     * 获取父级routes
     *
     * @return RouteCollection
     */
    function getParentRoutes()
    {
        if (is_null($this->_parentRoutes)) {
            $this->_parentRoutes = $this;
        }
        return $this->_parentRoutes;
    }

    /**
     * 设置顶级routes
     *
     * @return RouteCollection
     */
    function setTopRoutes(RouteCollection $routes)
    {
        $this->_topRoutes = $routes;
        return $this;
    }
    
    /**
     * 获取顶级routes
     * 
     * @return RouteCollection
     */
    function getTopRoutes()
    {
        if (is_null($this->_topRoutes)) {
            $this->_topRoutes = $this;
        }
        return $this->_topRoutes;
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
     * 是否有命名route
     * 
     * @param string $name
     */
    function hasNamedRoute($name)
    {
        return isset($this->_routes[$name]);
    }
    
    /**
     * 根据命名找到route
     *
     * @param string $name            
     * @param RouteInterface $route            
     * @return RouteInterface|null
     */
    function getRouteByName($name)
    {
        return isset($this->_routes[$name]) ? $this->_routes[$name] : null;
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

    /**
     * 返回route collection
     *
     * @return RouteCollection
     */
    function getRoutes()
    {
        return $this;
    }
}
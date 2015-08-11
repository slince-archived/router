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
    protected $_subCollections = [];

    /**
     * 父级routes
     *
     * @var RouteCollection
     */
    protected $_parentCollection;
    
    /**
     * 顶级routes
     *
     * @var RouteCollection
     */
    protected $_topCollection;

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
     * 添加一个子路由集合
     *
     * @param string $prefix            
     * @param RouteCollection $routes            
     */
    function addSubCollection($prefix, RouteCollection $collection)
    {
        $routes->setParentCollecton($this);
        $routes->setTopCollection($this->getTopRoutes());
        $this->_subCollections[$prefix] = $collection;
    }

    /**
     * 获取某个前缀下的子路由
     *
     * @param string $prefix            
     * @return RouteCollection
     */
    function getSubCollection($prefix)
    {
        return isset($this->_subCollections[$prefix]) ? $this->_subCollections[$prefix] : null;
    }

    /**
     * 是否有指定前缀的子集
     *
     * @param string $prefix
     */
    function hasSubCollection($prefix)
    {
        return isset($this->_subCollections[$prefix]);
    }
    
    /**
     * 设置父级routes
     *
     * @return RouteCollection
     */
    function setParentCollecton(RouteCollection $collection)
    {
        $this->_parentCollection = $collection;
        return $this;
    }
    /**
     * 获取父级routes
     *
     * @return RouteCollection
     */
    function getParentCollecton()
    {
        if (is_null($this->_parentCollection)) {
            $this->_parentCollection = $this;
        }
        return $this->_parentCollection;
    }

    /**
     * 设置顶级routes
     *
     * @return RouteCollection
     */
    function setTopCollection(RouteCollection $collection)
    {
        $this->_topCollection = $collection;
        return $this;
    }
    
    /**
     * 获取顶级routes
     * 
     * @return RouteCollection
     */
    function getTopCollection()
    {
        if (is_null($this->_topCollection)) {
            $this->_topCollection = $this;
        }
        return $this->_topCollection;
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
    function getRouteCollection()
    {
        return $this;
    }
}
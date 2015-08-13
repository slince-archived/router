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
     * 路由集合的前缀
     * 
     * @var string
     */
    protected $_prefix = '';

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
    protected $_collections = [];

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
        $route->setPreifx($this->_prefix);
        $this->_routes[] = $route;
        RouteStore::newInstance()->add($route);
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
     * 获取集合下所有的route
     * 
     * @return array
     */
    function getAll()
    {
        return $this->_routes;
    }
    
    /**
     * 添加一个子路由集合
     *
     * @param string $prefix            
     * @param RouteCollection $routes            
     */
    function addCollection($prefix, RouteCollection $collection)
    {
        $this->_collections[$prefix] = $collection;
    }

    /**
     * 获取某个前缀下的子路由
     *
     * @param string $prefix            
     * @return RouteCollection
     */
    function getCollection($prefix)
    {
        return isset($this->_collections[$prefix]) ? $this->_collections[$prefix] : null;
    }

    /**
     * 是否有指定前缀的子集
     *
     * @param string $prefix
     */
    function hasCollection($prefix)
    {
        return isset($this->_collections[$prefix]);
    }
    
    function setPreifx($prefix)
    {
        $this->_prefix = trim($prefix, '/');
    }
    
    function getPreifx()
    {
        return $this->_prefix;
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
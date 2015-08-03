<?php
namespace Slince\Router;

class RouteCollection implements \Countable, \IteratorAggregate
{
    
    use RouteCreatorTrait;
    
    protected $_routes = [];
    
    /**
     * 子集
     * 
     * @var array
     */
    protected $_subCollections = [];
    
    function __construct(array $routes = [])
    {
        $this->_routes = $routes;
    }
    
    static function create($routes = [])
    {
        return new self($routes);
    }
    function count()
    {
        return count($this->_routes);
    }
    
    function getIterator()
    {
        return new \ArrayIterator($this->_routes);
    }
    
    function add(RouteInterface $route)
    {
        $this->_routes[] = $route;
    }
    
    function addNamedRoute($name, RouteInterface $route)
    {
        $this->_routes[$name] = $route;
    }
    
    function replace(array $routes)
    {
        $this->_routes = $routes;
    }
    
    function addCollection($prefix, RouteCollection $routeCollection)
    {
        $this->_subCollections[$prefix] = $routeCollection;
    }
}
<?php
namespace Slince\Router;

class RouteCollection implements \Countable, \IteratorAggregate
{
    protected $_routes = [];
    
    protected $_subCollections = [];
    
    function __construct(array $routes = [])
    {
        $this->_routes = $routes;
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
}
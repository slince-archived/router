<?php
namespace Slince\Router;

class Router
{

    /**
     * route collection
     *
     * @var RouteCollection
     */
    protected $_routeCollection;
    
    function __construct()
    {
        
    }

    function add($uri, $parameters)
    {
        return $this->addRoute($uri, $parameters);
    }
    
    function get($uri, $parameters)
    {
        return $this->addRoute($uri, $parameters)
            ->setMethods([HttpMethod::GET, HttpMethod::HEAD]);
    }
    
    function post($uri, $parameters)
    {
        return $this->addRoute($uri, $parameters)
            ->setMethods([HttpMethod::POST]);
    }
    
    function put($uri, $parameters)
    {
        return $this->addRoute($uri, $parameters)
            ->setMethods([HttpMethod::PUT]);
    }
    
    function patch($uri, $parameters)
    {
        return $this->addRoute($uri, $parameters)
            ->setMethods([HttpMethod::PATCH]);
    }
    
    function patch($uri, $parameters)
    {
        return $this->addRoute($uri, $parameters)
            ->setMethods([HttpMethod::PATCH]);
    }
    
    function delete($uri, $parameters)
    {
        return $this->addRoute($uri, $parameters)
            ->setMethods([HttpMethod::DELETE]);
    }
    
    
    function addRoute($uri, $parameters)
    {
        $route = $this->newRoute($uri, $parameters);
        $this->_routeCollection->add($route);
        return $route;
    }
    
    function newRoute($uri, $parameters)
    {
        return new Route($uri, $parameters);
    }
    
    function prefix($prefix)
    {
        
    }
}
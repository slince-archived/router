<?php
namespace Slince\Router;

use Aura\Router\RouterFactory;

class Router
{
    private $_routeCollection = [];
    
    function setRouteCollection($routeCollection)
    {
        $this->_routeCollection = $routeCollection;
    }
    
    function prepare()
    {
        foreach ($this->_routeCollection->getNamedRoutes() as $name => $route) {
            RouterFactory::newInstance()->add($name, $route->getUri())
                ->setTokens();
        }
    }
    
    function match($uri)
    {
        
    }
    
}
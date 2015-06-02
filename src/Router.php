<?php
namespace Slince\Router;

class Router
{
    /**
     * @var RouteCollection
     */
    private $_routeCollection = [];
    
    function setRouteCollection(RouteCollection $routeCollection)
    {
        $this->_routeCollection = $routeCollection;
    }
    
    function prepare()
    {
        $routes = array_merge($this->_routeCollection->getNamedRoutes(), 
            $this->_routeCollection->getAnonymousRoutes());
        foreach ($routes as $route) {
            RouterFactory::newInstance()->add($route->getName(), $route->getUri())
                ->addTokens($route->getTokens())
                ->addValues($route->getParams());
        }
    }
    
    function match($path)
    {
        $route = RouterFactory::newInstance()->match($path, $_SERVER);
    }
    
}
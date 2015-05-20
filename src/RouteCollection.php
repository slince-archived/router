<?php
namespace Slince\Router;

class RouteCollection
{
    private $_anonymousRoutes = [];
    
    private $_namedRoutes = [];
    
    function add(RouteInterface $route)
    {
        if ($route->getName() == null) {
            $this->_anonymousRoutes[] = $route;
        }
        $this->_anonymousRoutes[] = $route;
    }
    
    function getNamedRoutes()
    {
        return $this->_namedRoutes;
    }
    
    function getAnonymousRoutes()
    {
        return $this->_anonymousRoutes;
    }
    
    function any($uri, $params, $options = [])
    {
        $route = RouteFactory::create($uri, $params, $options);
        $this->add($route);
    }
    
    function get($uri, $params, $options = [])
    {
        $options = ['allowedHttpMethods'=>[HttpMethods::HTTP_GET]] + $options;
        $this->any($uri, $action, $options);
    }
}
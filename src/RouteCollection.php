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
    
    function any($uri, $params, $tokens = [], $options = [])
    {
        $route = RouteFactory::create($uri, $params,$tokens, $options);
        $this->add($route);
    }
    
    function any($uri, $params, $tokens = [], $options = [])
    {
        $options = ['allowedHttpMethods' => [HttpMethods::HTTP_GET]] + $options;
        $this->any($uri, $action, $options);
    }
    
    function any($uri, $params, $tokens = [], $options = [])
    {
        $options = ['allowedHttpMethods' => [HttpMethods::HTTP_POST]] + $options;
        $this->any($uri, $action, $options);
    }
    
    function any($uri, $params, $tokens = [], $options = [])
    {
        $options = ['allowedHttpMethods' => [HttpMethods::HTTP_DELETE]] + $options;
        $this->any($uri, $action, $options);
    }
}
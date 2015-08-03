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

    function __construct(RouteCollection $routeCollection)
    {
        $this->_routeCollection = $routeCollection;
    }
    
    function match($path)
    {
        
    }
}
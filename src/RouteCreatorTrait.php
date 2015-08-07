<?php
namespace Slince\Router;

trait RouteCreatorTrait
{

    function http($path, $parameters)
    {
        return $this->addRoute($path, $parameters);
    }

    function https($path, $parameters)
    {
        return $this->addRoute($path, $parameters)->setSchemes([
            'https'
        ]);
    }

    function get($path, $parameters)
    {
        return $this->addRoute($path, $parameters)->setMethods([
            HttpMethod::GET,
            HttpMethod::HEAD
        ]);
    }

    function post($path, $parameters)
    {
        return $this->addRoute($path, $parameters)->setMethods([
            HttpMethod::POST
        ]);
    }

    function put($path, $parameters)
    {
        return $this->addRoute($path, $parameters)->setMethods([
            HttpMethod::PUT
        ]);
    }

    function patch($path, $parameters)
    {
        return $this->addRoute($path, $parameters)->setMethods([
            HttpMethod::PATCH
        ]);
    }

    function patch($path, $parameters)
    {
        return $this->addRoute($path, $parameters)->setMethods([
            HttpMethod::PATCH
        ]);
    }

    function delete($path, $parameters)
    {
        return $this->addRoute($path, $parameters)->setMethods([
            HttpMethod::DELETE
        ]);
    }

    function addRoute($path, $parameters)
    {
        $route = $this->newRoute($path, $parameters);
        $this->add($route);
        return $route;
    }

    function newRoute($path, $parameters)
    {
        return new Route($path, $parameters);
    }

    function prefix($prefix, \Closure $callback)
    {
        $routeCollection = RouteCollection::create();
        call_user_func($callback, $routeCollection);
        $this->addCollection($prefix, $routeCollection);
    }
}
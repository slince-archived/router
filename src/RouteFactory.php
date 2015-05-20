<?php
namespace Slince\Router;

class RouteFactory
{
    static function create($uri, $params, $options = []) 
    {
        return new Route($uri, $params, $options);
    }
}
<?php
namespace Slince\Router;

class RouteFactory
{
    static function create($uri, $params, $tokens = [], $options = []) 
    {
        return new Route($uri, $params, $tokens, $options);
    }
}
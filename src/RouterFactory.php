<?php
namespace Slince\Router;

class RouterFactory
{
    
    static function create()
    {
        return new Router(
            RouteCollection::create(),
            new Matcher(),
            new Generator()
        );
    }
}
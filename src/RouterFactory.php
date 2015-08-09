<?php
namespace Slince\Router;

class RouterFactory
{
    
    static function create(RequestContext $context = null)
    {
        return new Router(
            RouteCollection::create(),
            new Matcher(),
            new Generator(),
            $context
        );
    }
}
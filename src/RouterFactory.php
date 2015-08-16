<?php
/**
 * slince router library
 * @author Tao <taosikai@yeah.net>
 */
namespace Slince\Router;

class RouterFactory
{
    
    /**
     * 创建一个router
     * 
     * @param RequestContext $context
     * @return \Slince\Router\Router
     */
    static function create(RequestContext $context = null)
    {
        if (is_null($context)) {
            $context = RequestContext::create();
        }
        return new Router(
            RouteCollection::create(),
            new Matcher(),
            new Generator(),
            $context
        );
    }
}
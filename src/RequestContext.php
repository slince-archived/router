<?php
/**
 * slince router library
 * @author Tao <taosikai@yeah.net>
 */
namespace Slince\Router;

use Symfony\Component\Routing\RequestContext as SymfonyRequestContext;

class RequestContext extends SymfonyRequestContext
{

    /**
     * 实例化当前对象
     * 
     * @return \Slince\Router\RequestContext
     */
    static function create()
    {
        return new static();
    }
}
<?php
/**
 * slince router library
 * @author Tao <taosikai@yeah.net>
 */
namespace Slince\Router;

interface GeneratorInterface
{
    function generate(RouteInterface $route);
    
    /**
     * 设置上下文
     *
     * @param RequestContext $context
     */
    function setContext(RequestContext $context);
    
    /**
     * 获取上下文
     *
     * @return RequestContext $context
    */
    function getContext();
}
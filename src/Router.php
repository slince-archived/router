<?php
/**
 * slince router library
 * @author Tao <taosikai@yeah.net>
 */
namespace Slince\Router;

class Router
{

    /**
     * routes
     *
     * @var RouteCollection
     */
    protected $_routes;

    /**
     * matcher
     *
     * @var MatcherInterface
     */
    protected $_matcher;

    /**
     * generator
     *
     * @var GeneratorInterface
     */
    protected $_generator;

    /**
     * request context
     *
     * @var RequestContext
     */
    protected $_context;

    function __construct(RouteCollection $routes, MatcherInterface $matcher, GeneratorInterface $generator = null, RequestContext $context)
    {
        $this->_routes = $routes;
        $this->_matcher = $matcher;
        $this->_matcher->getValidators()->merge(ValidatorFactory::getDefaultValidators());
        $this->_generator = $generator;
        $this->_context = $context;
        $this->_matcher->setContext($context);
        $this->_generator->setContext($context);
    }

    /**
     * 匹配路径寻找路由
     * 
     * @param string $path            
     * @return Route
     */
    function match($path)
    {
        $route = $this->_matcher->match($path, $this->_routes);
        return $route;
    }

    /**
     * 生成一个路径
     * 
     * @param Route $route            
     */
    function generate(RouteInterface $route,  $parameters = [], $absolute = true)
    {
        return $this->_generator->generate($route, $parameters, $absolute);
    }

    /**
     * 获取routes
     *
     * @return \Slince\Router\RouteCollection
     */
    function getRoutes()
    {
        return $this->_routes;
    }

    /**
     * 获取matcher
     * 
     * @return \Slince\Router\MatcherInterface
     */
    function getMatcher()
    {
        return $this->_matcher;
    }

    /**
     * 设置上下文
     *
     * @param RequestContext $context            
     */
    function setContext(RequestContext $context)
    {
        $this->_context = $context;
    }

    /**
     * 获取上下文
     *
     * @return RequestContext $context
     */
    function getContext()
    {
        return $this->_context;
    }
}
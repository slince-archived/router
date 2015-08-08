<?php
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

    function __construct(RouteCollection $routes, MatcherInterface $matcher, GeneratorInterface $generator = null, RequestContext $context = null)
    {
        $this->_routes = $routes;
        $this->_matcher = $matcher;
        $this->_matcher->getValidators()->merge(ValidatorFactory::getDefaultValidators());
        $this->_generator = $generator;
        if (is_null($context)) {
            $context = RequestContext::create();
        }
        $this->_context = $context;
        $this->_matcher->setContext($context);
    }

    function match($path)
    {
        $route = $this->_matcher->match($path, $this->_routes);
        return $route;
    }
    
    function generate($route)
    {
        return $this->_generator->generate($route);
    }

    function getRoutes()
    {
        return $this->_routes;
    }

    function getMatcher()
    {
        return $this->_matcher;
    }
    
    /**
     * 获取路由的参数
     * 
     * @return array
     */
    function getRouteParams()
    {
        return [];
    }
}
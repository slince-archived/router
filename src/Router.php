<?php
namespace Slince\Router;

class Router
{

    /**
     * route collection
     *
     * @var RouteCollection
     */
    protected $_routeCollection;

    /**
     * matcher
     *
     * @var MatcherInterface
     */
    protected $_matcher;

    function __construct(RouteCollection $routeCollection, MatcherInterface $matcher)
    {
        $this->_routeCollection = $routeCollection;
        $this->_matcher = $matcher;
        $this->_matcher->getValidators()->merge(ValidatorFactory::getDefaultValidators());
    }

    function match($path)
    {
        $route = $this->_matcher->match($path, $this->_routeCollection);
    }

    function getRoutes()
    {
        return $this->_routeCollection;
    }

    function getMatcher()
    {
        return $this->_matcher;
    }
}
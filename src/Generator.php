<?php
/**
 * slince router library
 * @author Tao <taosikai@yeah.net>
 */
namespace Slince\Router;

use Symfony\Component\Routing\Generator\UrlGenerator;

class Generator extends UrlGenerator implements GeneratorInterface
{
    /**
     * request context
     * 
     * @var RequestContext
     */
    protected $_context;
    function generate(RouteInterface $route,  $parameters = [], $referenceType = self::ABSOLUTE_PATH)
    {
        $compiledRoute = $route->getCompiledRoute();
        return $this->doGenerate($compiledRoute->getVariables(), $route->getDefaults(), $route->getRequirements(), $compiledRoute->getTokens(), $parameters, $name, $referenceType, $compiledRoute->getHostTokens(), $route->getSchemes());
    }
    
    function generateByName($name, $parameters = [], $absolute = true)
    {
        $route = RouteStore::newInstance()->getByName($name);
        return $this->generate($route, $parameters, $absolute);
    }
    function generateByAction($action, $parameters = [], $absolute = true)
    {
        $route = RouteStore::newInstance()->getByAction($action);
        return $this->generate($route, $parameters, $absolute);
    }

    function getRouteScheme(RouteInterface $route)
    {
        $scheme = $this->_context->getScheme();
        $requiredSchemes = $route->getSchemes();
        if (! in_array($scheme, $requiredSchemes)) {
            $scheme = reset($requiredSchemes);
        }
        $port = '';
        if (strcasecmp($scheme, 'http') == 0 && $this->_context->getHttpPort() != 80) {
            $port = ':' . $this->_context->getHttpPort();
        } elseif(strcasecmp($scheme, 'https') == 0 && $this->_context->getHttpsPort() != 443) {
            $port = ':' . $this->_context->getHttpsPort();
        }
        return "{$scheme}{$port}//";
    }
    
    function getRouteDomain(RouteInterface $route)
    {
        $requireDomain = $route->getDomain();
        if (is_null($requireDomain)) {
            return $this->_context->getHost();
        }
        
    }
    function getDomain()
    {
        return preg_replace_callback('/\{(.*?)\??\}/', function ($m) use (&$parameters) {
            return isset($parameters[$m[1]]) ? Arr::pull($parameters, $m[1]) : $m[0];
        
        }, $path);
    }
    /**
     * (non-PHPdoc)
     * @see \Slince\Router\GeneratorInterface::setContext()
     */
    function setContext(RequestContext $context)
    {
        $this->context = $context;
    }
    

    /**
     * (non-PHPdoc)
     * @see \Slince\Router\GeneratorInterface::getContext()
     */
    function getContext()
    {
        return $this->context;
    }
}
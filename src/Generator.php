<?php
/**
 * slince router library
 * @author Tao <taosikai@yeah.net>
 */
namespace Slince\Router;

class Generator implements GeneratorInterface
{

    /**
     * request context
     *
     * @var RequestContext
     */
    protected $_context;

    /**
     * 存储最近一个route的route param
     *
     * @var array
     */
    protected $_routeParameters;

    function generate(RouteInterface $route, $parameters = [], $absolute = true)
    {
        $compiledRoute = $route->getCompiledRoute();
        // 提供的初始化route parameter
        $this->_routeParameters = array_merge($route->getParameters(), $this->_context->getParameters(), $parameters);
        $uri = '';
        // 生成绝对路径，需要构建scheme domain port
        if ($absolute) {
            list ($scheme, $port) = $this->getRouteSchemeAndPort($route);
            $domain = $this->getRouteDomain($route);
            $uri .= "{$scheme}://{$domain}{$port}";
        }
        $uri .= $this->getRoutePath($route);
        return $uri;
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

    function getRouteSchemeAndPort(RouteInterface $route)
    {
        $scheme = $this->_context->getScheme();
        $requiredSchemes = $route->getSchemes();
        if (! empty($requiredSchemes) && ! in_array($scheme, $requiredSchemes)) {
            $scheme = reset($requiredSchemes);
        }
        $port = '';
        if (strcasecmp($scheme, 'http') == 0 && $this->_context->getHttpPort() != 80) {
            $port = ':' . $this->_context->getHttpPort();
        } elseif (strcasecmp($scheme, 'https') == 0 && $this->_context->getHttpsPort() != 443) {
            $port = ':' . $this->_context->getHttpsPort();
        }
        return [
            $scheme,
            $port
        ];
    }

    function getRouteDomain(RouteInterface $route)
    {
        // 如果route没有主机域名限制则直接使用环境中主机
        $requireDomain = $route->getDomain();
        if (is_null($requireDomain)) {
            return $this->_context->getHost();
        }
        // 有限制则根据route的host限制生成域名
        return $this->formateRouteDomain($route);
    }

    function formateRouteDomain(RouteInterface $route)
    {
        $domain = $this->formateRouteParameters($route->getDomain(), $this->_routeParameters);
        return $domain;
    }

    function getRoutePath(RouteInterface $route)
    {
        return $this->formateRouteParameters($route->getPath(), $this->_routeParameters);
    }

    function formateRouteParameters($path, $parameters)
    {
        return preg_replace_callback('#\{([a-zA-Z0-9_,]*)\}#', function ($matches) use($parameters)
        {
            return isset($parameters[$matches[1]]) ? $parameters[$matches[1]] : '';
        }, $path);
    }

    function getDomain()
    {
        return preg_replace_callback('/\{(.*?)\??\}/', function ($m) use(&$parameters)
        {
            return isset($parameters[$m[1]]) ? Arr::pull($parameters, $m[1]) : $m[0];
        }, $path);
    }

    /**
     * (non-PHPdoc)
     * 
     * @see \Slince\Router\GeneratorInterface::setContext()
     */
    function setContext(RequestContext $context)
    {
        $this->_context = $context;
    }

    /**
     * (non-PHPdoc)
     * 
     * @see \Slince\Router\GeneratorInterface::getContext()
     */
    function getContext()
    {
        return $this->_context;
    }
}
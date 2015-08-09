<?php
/**
 * slince router library
 * @author Tao <taosikai@yeah.net>
 */
namespace Slince\Router;

trait RouteCreatorTrait
{

    /**
     * 创建一个普通路由，addRoute别名
     *
     * @param string $path            
     * @param array $parameters            
     */
    function http($path, $parameters, $options = [])
    {
        return $this->addRoute($path, $parameters, $options);
    }

    /**
     * 创建一个https路由
     *
     * @param string $path            
     * @param array $parameters            
     */
    function https($path, $parameters, $options = [])
    {
        return $this->addRoute($path, $parameters, $options)->setSchemes([
            'https'
        ]);
    }

    /**
     * 创建一个get路由
     *
     * @param string $path            
     * @param array $parameters            
     */
    function get($path, $parameters, $options = [])
    {
        return $this->addRoute($path, $parameters, $options)->setMethods([
            HttpMethod::GET,
            HttpMethod::HEAD
        ]);
    }

    /**
     * 创建一个post路由
     *
     * @param string $path            
     * @param array $parameters            
     */
    function post($path, $parameters, $options = [])
    {
        return $this->addRoute($path, $parameters, $options)->setMethods([
            HttpMethod::POST
        ]);
    }

    /**
     * 创建一个put路由
     *
     * @param string $path            
     * @param array $parameters            
     */
    function put($path, $parameters, $options = [])
    {
        return $this->addRoute($path, $parameters, $options)->setMethods([
            HttpMethod::PUT
        ]);
    }

    /**
     * 创建一个patch路由
     *
     * @param string $path            
     * @param array $parameters            
     */
    function patch($path, $parameters, $options = [])
    {
        return $this->addRoute($path, $parameters, $options)->setMethods([
            HttpMethod::PATCH
        ]);
    }

    /**
     * 创建一个delete路由
     *
     * @param string $path            
     * @param array $parameters            
     */
    function delete($path, $parameters, $options = [])
    {
        return $this->addRoute($path, $parameters, $options)->setMethods([
            HttpMethod::DELETE
        ]);
    }

    /**
     * 创建并添加一个路由
     *
     * @param string $path            
     * @param array $parameters            
     */
    function addRoute($path, $parameters, $options = [])
    {
        $route = $this->newRoute($path, $parameters);
        if (isset($options['as'])) {
            $route->setOption('name', $options['as']);
            $this->getRoutes()->addNamedRoute($options['as'], $route);
        } else {
            $this->getRoutes()->add($route);
        }
        return $route;
    }

    /**
     * 创建一个路由
     *
     * @param string $path            
     * @param array $parameters            
     * @return Route
     */
    function newRoute($path, $parameters, $options = [])
    {
        return new Route($path, $parameters, $options = []);
    }

    /**
     * 创建一个前缀
     *
     * @param string $prefix            
     * @param \Closure $callback            
     */
    function prefix($prefix, \Closure $callback)
    {
        $routes = RouteCollection::create();
        call_user_func($callback, $routes);
        $this->getRoutes()->addSubRoutes($prefix, $routes);
    }
    
    /**
     * 返回适配的routecollection
     * 
     * @return RouteCollection
     */
    abstract function getRoutes();
}
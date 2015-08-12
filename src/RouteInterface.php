<?php
/**
 * slince router library
 * @author Tao <taosikai@yeah.net>
 */
namespace Slince\Router;

interface RouteInterface
{

    /**
     * 设置path
     *
     * @param string $path
     *            path
     * @return RouteInterface
     */
    function setPath($path);

    /**
     * get path
     *
     * @return string path
     */
    function getPath();

    /**
     * 设置路由响应操作
     * 
     * @param mixed $action
     */
    function setAction($action);
    
    /**
     * 获取路由响应
     */
    function getAction();
    
    /**
     * 设置parameter
     *
     * @param string $name            
     * @param mixed $parameter            
     * @return RouteInterface
     */
    function setParameter($name, $parameter);

    /**
     * 获取parameter
     *
     * @param string $name            
     * @param string $default            
     * @return RouteInterface
     */
    function getParameter($name, $default = null);

    /**
     * 设置parameters
     *
     * @param array $parameters            
     * @return RouteInterface
     */
    function setParameters(array $parameters);

    /**
     * 获取parameters
     *
     * @return array
     */
    function getParameters();

    /**
     * 设置requirements
     *
     * @param array $requirements            
     * @return RouteInterface
     */
    function setRequirements(array $requirements);

    /**
     * 单个设置requirement
     *
     * @param string $name            
     * @param string $requirement            
     * @return RouteInterface
     */
    function setRequirement($name, $requirement);

    /**
     * 获取requirements
     *
     * @return array
     */
    function getRequirements();

    /**
     * 添加requirements
     *
     * @param array $requirements            
     * @return RouteInterface
     */
    function addRequirements(array $requirements);

    /**
     * 获取requirement
     *
     * @param string $name            
     * @param string $default            
     * @return string
     */
    function getRequirement($name, $default = null);

    /**
     * 设置schemes
     *
     * @param array $schemes            
     * @return RouteInterface
     */
    function setSchemes(array $schemes);

    /**
     * 获取schemes
     *
     * @return array
     */
    function getSchemes();

    /**
     * 设置methods
     *
     * @param array $methods            
     * @return RouteInterface
     */
    function setMethods(array $methods);

    /**
     * 获取method
     *
     * @return array
     */
    function getMethods();

    /**
     * 设置domain
     *
     * @param string $domain            
     * @return RouteInterface
     */
    function setDomain($domain);

    /**
     * 获取domain
     *
     * @return array
     */
    function getDomain();

    /**
     * 设置options
     *
     * @param array $options            
     * @return RouteInterface
     */
    function setOptions(array $options);
    
    /**
     * 设置option
     *
     * @param string $name
     * @param mixed $option            
     * @return RouteInterface
     */
    function setOption($name, $option);

    /**
     * 获取options
     *
     * @return array
     */
    function getOptions();

    /**
     * 获取option
     *
     * @param string $name            
     * @param mixed $default            
     */
    function getOption($name, $default);

    /**
     * 记录验证器的验证
     *
     * @param string $validatorId            
     */
    function setReport($validatorId, $report);

    /**
     * 获取验证结果
     */
    function getReport($validatorId = null);

    /**
     * 设置处理之后的路由参数
     *
     * @param array $parameters            
     * @return RouteInterface
     */
    function setRouteParameters(array $parameters);

    /**
     * 获取路由参数
     *
     * @return array
     */
    function getRouteParameters();

    /**
     * 获取编译后的route
     *
     * @return \Symfony\Component\Routing\CompiledRoute
     */
    function getCompiledRoute();

    /**
     * 重新编译route
     *
     * @return \Symfony\Component\Routing\CompiledRoute
     */
    function compile();
}
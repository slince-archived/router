<?php
namespace Slince\Router;

interface RouteInterface
{

    function setPath($path);
    
    function getPath();

    function setParameter($name, $parameter);
    
    function getParameter($name, $default = null);
    
    function setParameters(array $parameters);
    
    function getParameters();

    function setRequirements(array $requirements);
    
    function getRequirements();

    function addRequirements(array $requirements);
    
    function getRequirement($name, $default);
    
    function setSchemes(array $schemes);
    
    function getSchemes();

    function setMethods(array $methods);
    
    function getMethods();
    
    function setDomain($domain);
    
    function getDomain();
    
    /**
     * 获取编译后的route
     * @return Symfony\Component\Routing\CompiledRoute
     */
    function getCompiledRoute();
    
    /**
     * 重新编译route
     * 
     * @return Symfony\Component\Routing\CompiledRoute
     */
    function recompile();
}
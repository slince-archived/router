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
    
    function setRequirement($name, $requirement);
    
    function getRequirements();

    function addRequirements(array $requirements);
    
    function getRequirement($name, $default);
    
    function setSchemes(array $schemes);
    
    function getSchemes();

    function setMethods(array $methods);
    
    function getMethods();
    
    function setDomain($domain);
    
    function getDomain();

    function setOptions(array $options);
    
    function getOptions();
    
    function getOption($name, $default);
    
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
    
    /**
     * 记录不通过的原因
     * @param string $validatorId
     */
    function setReport($validatorId);
    
    /**
     * 获取不通过的原因
     */
    function getReport();
}
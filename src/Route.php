<?php
namespace Slince\Router;

use Symfony\Component\Routing\Route as SymfonyRoute;

class Route implements RouteInterface
{

    protected $_path;

    protected $_parameters;

    protected $_requirements;

    protected $_options;
    
    protected $_schemes;

    protected $_methods;

    protected $_domain;
    
    protected $_compiledRoute;
    
    protected $_report;
    
    function __construct($path, array $parameters = [], array $requirements = [], array $options = [], $domain = '', array $schemes = [], array $methods = [])
    {
        $this->_path = $path;
        $this->_parameters = $parameters;
        $this->_requirements = $requirements;
        $this->_options = $options;
        $this->_domain = $domain;
        $this->_schemes = $schemes;
        $this->_methods = $methods;
    }
    function getCompiledRoute()
    {
        if (is_null($this->_compiledRoute)) {
            $this->recompile();
        }
        return $this->_compiledRoute;
    }
    
    function recompile()
    {
        return $this->_compiledRoute = (new SymfonyRoute($this->_path,
            $this->_parameters,
            $this->_requirements,
            $this->_options,
            $this->_domain,
            $this->_schemes,
            $this->_methods
        ))->compile();
    }
    
    function setPath($path)
    {
        $this->_path = $path;
    }
    
    function getPath()
    {
        return $this->_path;
    }
    
    function setParameter($name, $parameter)
    {
        $this->_parameters[$name] = $parameter;
    }
    
    function getParameter($name, $default = null)
    {
        return isset($this->_parameters[$name]) ? $this->_parameters[$name] : $default;
    }
    
    function setParameters(array $parameters)
    {
        $this->_parameters = $parameters;
    }
    
    function getParameters()
    {
        return $this->_parameters;
    }
    
    function setRequirements(array $requirements)
    {
        $this->_requirements = $requirements;
    }
    
    function setRequirement($name, $requirement)
    {
        $this->_requirements[$name] = $requirement;
    }
    
    function getRequirements()
    {
        return $this->_requirements;
    }
    
    function addRequirements(array $requirements)
    {
        $this->_requirements += $requirements;
    }
    
    function getRequirement($name, $default)
    {
        return isset($this->_requirements[$name]) ? $this->_requirements[$name] : $default; 
    }

    function setSchemes(array $schemes)
    {
        $this->_schemes = $schemes;
    }
    
    function getSchemes()
    {
        return $this->_schemes;
    }
    
    function setMethods(array $methods)
    {
        $this->_methods = $methods;
    }
    
    function getMethods()
    {
        return $this->_methods;
    }
    
    function setDomain($domain)
    {
        $this->_domain = $domain;
    }
    
    function getDomain()
    {
        return $this->_domain;
    }
    
    function setOptions(array $options)
    {
        $this->_options = $options;
    }
    
    function getOptions()
    {
        return $this->_options;
    }
    
    function getOption($name, $default)
    {
        isset($this->_options[$name]) ? $this->_options[$name] : $default;
    }
    
    function setReport($validatorId)
    {
        $this->_report = $validatorId;
    }
    
    function getReport()
    {
        return $this->_report;
    }
}
<?php
/**
 * slince router library
 * @author Tao <taosikai@yeah.net>
 */
namespace Slince\Router;

use Symfony\Component\Routing\Route as SymfonyRoute;
use Slince\Router\Exception\InvalidParameterException;

class Route implements RouteInterface
{

    /**
     * 路由前缀
     *
     * @var string
     */
    protected $_prefix = '/';

    /**
     * path
     *
     * @var string
     */
    protected $_path;

    /**
     * 默认参数
     *
     * @var array
     */
    protected $_parameters;

    /**
     * requirements
     *
     * @var array
     */
    protected $_requirements;

    /**
     * options
     *
     * @var array
     */
    protected $_options;

    /**
     * schemes
     *
     * @var array
     */
    protected $_schemes;

    /**
     * methods
     *
     * @var array
     */
    protected $_methods;

    /**
     * domain
     *
     * @var string
     */
    protected $_domain;

    /**
     * compiled route
     *
     * @var \Symfony\Component\Routing\CompiledRoute
     */
    protected $_compiledRoute;

    /**
     * 验证器报告
     *
     * @var array
     */
    protected $_report;

    /**
     * 验证之后的路由参数
     *
     * @var array
     */
    protected $_routeParameters;

    function __construct($path, $parameters, array $requirements = [], array $options = [], $domain = '', array $schemes = [], array $methods = [])
    {
        $this->setPath($path);
        $parameters = $this->_parseParameters($parameters);
        $this->_parameters = $parameters;
        $this->_requirements = $requirements;
        $this->_options = $options;
        $this->_domain = $domain;
        $this->_schemes = $schemes;
        $this->_methods = $methods;
    }

    /**
     * (non-PHPdoc)
     *
     * @see \Slince\Router\RouteInterface::setPath()
     */
    function setPath($path)
    {
        $this->_path = '/' . trim($path, '/');
        return $this;
    }

    /**
     * (non-PHPdoc)
     *
     * @see \Slince\Router\RouteInterface::getPath()
     */
    function getPath()
    {
        return $this->_path;
    }

    /**
     * (non-PHPdoc)
     *
     * @see \Slince\Router\RouteInterface::setParameter()
     */
    function setParameter($name, $parameter)
    {
        $this->_parameters[$name] = $parameter;
        return $this;
    }

    /**
     * (non-PHPdoc)
     *
     * @see \Slince\Router\RouteInterface::getParameter()
     */
    function getParameter($name, $default = null)
    {
        return isset($this->_parameters[$name]) ? $this->_parameters[$name] : $default;
    }

    /**
     * (non-PHPdoc)
     *
     * @see \Slince\Router\RouteInterface::hasParameter()
     */
    function hasParameter($name)
    {
        return isset($this->_parameters[$name]);
    }

    /**
     * (non-PHPdoc)
     *
     * @see \Slince\Router\RouteInterface::setParameters()
     */
    function setParameters(array $parameters)
    {
        $this->_parameters = $parameters;
        return $this;
    }

    /**
     * (non-PHPdoc)
     *
     * @see \Slince\Router\RouteInterface::getParameters()
     */
    function getParameters()
    {
        return $this->_parameters;
    }

    /**
     * (non-PHPdoc)
     *
     * @see \Slince\Router\RouteInterface::setRequirements()
     */
    function setRequirements(array $requirements)
    {
        $this->_requirements = $requirements;
        return $this;
    }

    /**
     * (non-PHPdoc)
     *
     * @see \Slince\Router\RouteInterface::setRequirement()
     */
    function setRequirement($name, $requirement)
    {
        $this->_requirements[$name] = $requirement;
        return $this;
    }

    /**
     * (non-PHPdoc)
     *
     * @see \Slince\Router\RouteInterface::getRequirements()
     */
    function getRequirements()
    {
        return $this->_requirements;
    }

    /**
     * (non-PHPdoc)
     *
     * @see \Slince\Router\RouteInterface::addRequirements()
     */
    function addRequirements(array $requirements)
    {
        $this->_requirements += $requirements;
        return $this;
    }

    /**
     * (non-PHPdoc)
     *
     * @see \Slince\Router\RouteInterface::getRequirement()
     */
    function getRequirement($name, $default = null)
    {
        return isset($this->_requirements[$name]) ? $this->_requirements[$name] : $default;
    }

    /**
     * (non-PHPdoc)
     *
     * @see \Slince\Router\RouteInterface::setSchemes()
     */
    function setSchemes(array $schemes)
    {
        $this->_schemes = $schemes;
        return $this;
    }

    /**
     * (non-PHPdoc)
     *
     * @see \Slince\Router\RouteInterface::getSchemes()
     */
    function getSchemes()
    {
        return $this->_schemes;
    }

    /**
     * (non-PHPdoc)
     *
     * @see \Slince\Router\RouteInterface::setMethods()
     */
    function setMethods(array $methods)
    {
        $this->_methods = array_map('strtolower', $methods);
        return $this;
    }

    /**
     * (non-PHPdoc)
     *
     * @see \Slince\Router\RouteInterface::getMethods()
     */
    function getMethods()
    {
        return $this->_methods;
    }

    /**
     * (non-PHPdoc)
     *
     * @see \Slince\Router\RouteInterface::setDomain()
     */
    function setDomain($domain)
    {
        $this->_domain = $domain;
        return $this;
    }

    /**
     * (non-PHPdoc)
     *
     * @see \Slince\Router\RouteInterface::getDomain()
     */
    function getDomain()
    {
        return $this->_domain;
    }

    /**
     * (non-PHPdoc)
     *
     * @see \Slince\Router\RouteInterface::setOptions()
     */
    function setOptions(array $options)
    {
        $this->_options = $options;
        return $this;
    }

    /**
     * (non-PHPdoc)
     *
     * @see \Slince\Router\RouteInterface::setOption()
     */
    function setOption($name, $option)
    {
        $this->_options[$name] = $option;
        return $this;
    }

    /**
     * (non-PHPdoc)
     *
     * @see \Slince\Router\RouteInterface::getOptions()
     */
    function getOptions()
    {
        return $this->_options;
    }

    /**
     * (non-PHPdoc)
     *
     * @see \Slince\Router\RouteInterface::getOption()
     */
    function getOption($name, $default)
    {
        return isset($this->_options[$name]) ? $this->_options[$name] : $default;
    }

    /**
     * (non-PHPdoc)
     *
     * @see \Slince\Router\RouteInterface::hasOption()
     */
    function hasOption($name)
    {
        return isset($this->_options[$name]);
    }

    /**
     * 给路径设置前缀
     *
     * @param string $prefix            
     * @return \Slince\Router\Route
     */
    function setPreifx($prefix)
    {
        $this->_prefix = '/' . trim($prefix, '/');
        return $this;
    }

    /**
     * (non-PHPdoc)
     * @see \Slince\Router\RouteInterface::getPrefix()
     */
    function getPrefix()
    {
        return $this->_prefix;
    }

    /**
     * 获取带prefix的path
     * 
     * @return string
     */
    function getFullPath()
    {
        return $this->_prefix . $this->_path;
    }

    /**
     * (non-PHPdoc)
     *
     * @see \Slince\Router\RouteInterface::setReport()
     */
    function setReport($validatorId, $report)
    {
        $this->_report[$validatorId] = $report;
        return $this;
    }

    /**
     * (non-PHPdoc)
     *
     * @see \Slince\Router\RouteInterface::getReport()
     */
    function getReport($validatorId = null)
    {
        if (is_null($validatorId)) {
            return $this->_report;
        } else {
            return $this->_report[$validatorId];
        }
    }

    /**
     * (non-PHPdoc)
     *
     * @see \Slince\Router\RouteInterface::setRouteParameters()
     */
    function setRouteParameters(array $parameters)
    {
        $this->_routeParameters = $parameters;
    }

    /**
     * (non-PHPdoc)
     *
     * @see \Slince\Router\RouteInterface::getRouteParameters()
     */
    function getRouteParameters()
    {
        return $this->_routeParameters;
    }

    /**
     * (non-PHPdoc)
     *
     * @see \Slince\Router\RouteInterface::getCompiledRoute()
     */
    function getCompiledRoute()
    {
        if (is_null($this->_compiledRoute)) {
            $this->compile();
        }
        return $this->_compiledRoute;
    }

    /**
     * (non-PHPdoc)
     *
     * @see \Slince\Router\RouteInterface::recompile()
     */
    function compile()
    {
        return $this->_compiledRoute = (new SymfonyRoute($this->_path, $this->_parameters, $this->_requirements, [], $this->_domain, $this->_schemes, $this->_methods))->compile();
    }

    /**
     * route参数解析
     * @param mixed $parameters
     * @return array
     */
    protected function _parseParameters($parameters)
    {
        if (is_callable($parameters) || (is_string($parameters) && strpos($parameters, '@') !== false)) {
            return [
                'action' => $parameters
            ];
        }
        if (is_array($parameters) && isset($parameters['action'])) {
            return $parameters;
        }
        throw new InvalidParameterException("Must provide the action argument");
    }
}
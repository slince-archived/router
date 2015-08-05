<?php
namespace Slince\Router;

use Symfony\Component\Routing\Route as SymfonyRoute;

class Route implements RouteInterface
{

    protected $_uri;

    protected $_parameters;

    protected $_requirements;

    protected $_schemes;

    protected $_methods;

    protected $_domain;
    
    protected $_compiledRoute;

    function compile()
    {
        if (! is_null($this->_compiledRoute)) {
            $this->_compiledRoute = (new SymfonyRoute($this->_uri,
                $this->_parameters,
                $this->_requirements,
                $this->_options,
                $this->_domain,
                $this->_schemes,
                $this->_methods
            ))->compile();
        }
        return $this->_compiledRoute;
    }
    
    
}
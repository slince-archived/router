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

    function compile()
    {
        return new SymfonyRoute($this->_uri, $this->_params);
    }
}
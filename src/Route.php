<?php
namespace Slince\Router;

class Route implements RouteInterface
{

    private $_uri;

    private $_params;

    private $_options = [
        'name' => null,
        'format' => null,
        'allowedHttpMethods' => null,
        'redirect' => null
    ];

    function __construct($uri, $params, $options = [])
    {
        $this->_uri = $uri;
        $this->_params = $params;
        $this->_options = array_merge($this->_options, $options);
    }

    function getUri()
    {
        return $this->_uri;
    }

    function setUri($uri)
    {
        $this->_uri = $uri;
        return $this;
    }

    function getParams()
    {
        return $this->_params;
    }

    function setParams($params)
    {
        $this->_params = $params;
        return $this;
    }

    function getOptions()
    {
        return $this->_options;
    }
}
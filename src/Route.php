<?php
namespace Slince\Router;

class Route implements RouteInterface
{

    private $_uri;

    private $_params;
    
    private $_tokens = [];

    private $_options = [
        'name' => null,
        'format' => null,
        'allowedHttpMethods' => null,
        'redirect' => null
    ];

    function __construct($uri, $params, $tokens = [], $options = [])
    {
        $this->_uri = $uri;
        $this->_params = $params;
        $this->_tokens = $tokens;
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
    
    function getTokens()
    {
        return $this->_tokens;
    }

    function setTokens($tokens)
    {
        $this->_tokens = $tokens;
        return $this;
    }

    function getOptions()
    {
        return $this->_options;
    }
}
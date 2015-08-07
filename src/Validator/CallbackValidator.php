<?php
namespace Slince\Router\Validator;

class CallbackValidator implements ValidatorInterface
{

    private $_callback;

    static $id = null;

    function __construct(\Closure $callback)
    {
        $this->_callback = $callback;
    }

    function validate($route, $requestContext)
    {
        return call_user_func($this->_callback, $route, $requestContext);
    }
}
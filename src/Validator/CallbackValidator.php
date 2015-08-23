<?php
/**
 * slince router library
 * @author Tao <taosikai@yeah.net>
 */
namespace Slince\Router\Validator;

class CallbackValidator implements ValidatorInterface
{

    private $_callback;

    static $id = null;

    /**
     *
     * @param \Closure $callback            
     */
    function __construct(\Closure $callback)
    {
        $this->_callback = $callback;
        self::$id = spl_object_hash($callback);
    }

    function validate($route, $context)
    {
        return call_user_func($this->_callback, $route, $context);
    }
}
<?php
namespace Slince\Router;

use Slince\Router\Validator\CallbackValidator;

class ValidatorFactory
{
    static $validators = [];
    
    static function newValidators()
    {
        if (isset(self::$validators)) {
            return self::$validators;
        }
        return self::$validators = [
            new MethodValidator, new SchemeValidator,
            new HostValidator, new UriValidator,
        ];
    }
    
    static function createCallbackValidator(\Closure $callback)
    {
        return new CallbackValidator($callback);
    }
}
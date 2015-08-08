<?php
namespace Slince\Router;

use Slince\Router\Validator\CallbackValidator;
use Slince\Router\Validator\MethodValidator;
use Slince\Router\Validator\SchemeValidator;
use Slince\Router\Validator\HostValidator;
use Slince\Router\Validator\PathValidator;

class ValidatorFactory
{
    static $validators = [];
    
    static function getDefaultValidators()
    {
        if (empty(self::$validators)) {
            self::$validators = [
                new MethodValidator, new SchemeValidator,
                new HostValidator, new PathValidator,
            ];
        }
        return self::$validators;
    }
    
    static function createCallbackValidator(\Closure $callback)
    {
        return new CallbackValidator($callback);
    }
}
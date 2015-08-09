<?php
/**
 * slince router library
 * @author Tao <taosikai@yeah.net>
 */
namespace Slince\Router;

use Slince\Router\Validator\CallbackValidator;
use Slince\Router\Validator\MethodValidator;
use Slince\Router\Validator\SchemeValidator;
use Slince\Router\Validator\HostValidator;
use Slince\Router\Validator\PathValidator;

class ValidatorFactory
{

    /**
     * default validators
     * 
     * @var array
     */
    static $validators = [];

    /**
     * 获取默认的validators
     * 
     * @return array
     */
    static function getDefaultValidators()
    {
        if (empty(self::$validators)) {
            self::$validators = [
                new MethodValidator(),
                new SchemeValidator(),
                new HostValidator(),
                new PathValidator()
            ];
        }
        return self::$validators;
    }
    
    /**
     * 创建一个自定义validator
     * @param \Closure $callback
     * @return \Slince\Router\Validator\CallbackValidator
     */
    static function createCallbackValidator(\Closure $callback)
    {
        return new CallbackValidator($callback);
    }
}
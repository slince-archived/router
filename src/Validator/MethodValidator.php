<?php
/**
 * slince router library
 * @author Tao <taosikai@yeah.net>
 */
namespace Slince\Router\Validator;

use Slince\Router\RouteInterface;
use Slince\Router\RequestContext;

class MethodValidator implements ValidatorInterface
{
    
    static $id = 'method';
    
    /**
     * (non-PHPdoc)
     * @see \Slince\Router\Validator\ValidatorInterface::validate()
     */
    function validate(RouteInterface $route, RequestContext $context)
    {
        return ! $route->getMethods() || in_array($context->getMethod(), $route->getMethods());
    }
}
<?php
namespace Slince\Router\Validator;

use Slince\Router\RouteInterface;
use Slince\Router\RequestContext;

class MethodValidator implements ValidatorInterface
{
    
    static $id = 'method';
    
    function validate(RouteInterface $route, RequestContext $context)
    {
        return ! $route->getMethods() || in_array($context->getMethod(), $route->getMethods());
    }
}
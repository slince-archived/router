<?php
namespace Slince\Router\Validator;

use Slince\Router\RouteInterface;
use Slince\Router\RequestContext;

class HostValidator implements ValidatorInterface
{
    
    static $id = 'host';
    
    function validate(RouteInterface $route, RequestContext $context)
    {
        return ! $route->getCompiledRoute()->getHostRegex() ||
           preg_match($route->getCompiledRoute()->getHostRegex(), $this->context->getHost());
    }
}
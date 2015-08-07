<?php
namespace Slince\Router\Validator;

use Slince\Router\Validator\ValidatorInterface;
use Slince\Router\RouteInterface;
use Slince\Router\RequestContext;

class HostValidator implements ValidatorInterface
{
    
    static $id = 'host';
    
    function validate(RouteInterface $route, RequestContext $requestContext)
    {
        return ! $route->getCompiledRoute()->getHostRegex() ||
           preg_match($route->getCompiledRoute()->getHostRegex(), $this->context->getHost());
    }
}
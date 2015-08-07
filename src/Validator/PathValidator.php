<?php
namespace Slince\Router\Validator;

use Slince\Router\Validator\ValidatorInterface;
use Slince\Router\RouteInterface;
use Slince\Router\RequestContext;

class PathValidator implements ValidatorInterface
{
    
    static $id = 'path';
    
    function validate(RouteInterface $route, RequestContext $requestContext)
    {
        return preg_match($route->getCompiled()->getRegex(), rawurldecode($requestContext->getParameter('path')));
    }
}
<?php
namespace Slince\Router\Validator;

use Slince\Router\RouteInterface;
use Slince\Router\RequestContext;

class SchemeValidator implements ValidatorInterface
{

    static $id = 'scheme';
    
    function validate(RouteInterface $route, RequestContext $context)
    {
        return ! $route->getSchemes() || in_array($context->getScheme(), $route->getSchemes());
    }
}

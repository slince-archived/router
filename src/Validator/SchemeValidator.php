<?php
namespace Slince\Router\Validator;

use Slince\Router\Validator\ValidatorInterface;
use Slince\Router\RouteInterface;
use Slince\Router\RequestContext;

class SchemeValidator implements ValidatorInterface
{

    static $id = 'scheme';
    
    function validate(RouteInterface $route, RequestContext $context)
    {
        return in_array($context->getScheme(), $route->getSchemes());
    }
}

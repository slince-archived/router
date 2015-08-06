<?php
namespace Slince\Router\Validator;

use Slince\Router\Validator\ValidatorInterface;
use Slince\Router\RouteInterface;
use Slince\Router\RequestContext;

class HostValidator implements ValidatorInterface
{
    function validate(RouteInterface $route, RequestContext $requestContext)
    {
        if ($route->getCompiledRoute()->getHostRegex() && !preg_match($compiledRoute->getHostRegex(), $this->context->getHost(), $hostMatches)) {
            continue;
        }
    }
}
<?php
namespace Slince\Router\Validator;

use Slince\Router\RouteInterface;
use Slince\Router\RequestContext;

class HostValidator implements ValidatorInterface
{
    
    static $id = 'host';
    
    function validate(RouteInterface $route, RequestContext $context)
    {
        $matches = [];
        $result = ! $route->getCompiledRoute()->getHostRegex() ||
           preg_match($route->getCompiledRoute()->getHostRegex(), $context->getHost(), $matches);
        if ($result) {
            $route->setReport(self::$id, $matches);
        }
        return $result;
    }
}
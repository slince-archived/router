<?php
namespace Slince\Router\Validator;

use Slince\Router\RouteInterface;
use Slince\Router\RequestContext;

class PathValidator implements ValidatorInterface
{
    
    static $id = 'path';
    
    function validate(RouteInterface $route, RequestContext $context)
    {
        $matches = [];
        $result = preg_match($route->getCompiledRoute()->getRegex(), rawurldecode($context->getParameter('path')), $matches);
        if ($result) {
            $route->setReport(self::$id, $matches);
        }
        return $result;
    }
}
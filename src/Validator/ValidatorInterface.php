<?php
namespace Slince\Router\Validator;

use Slince\Router\RouteInterface;
use Slince\Router\RequestContext;

interface ValidatorInterface
{

    static $id = null;
    
    function validate(RouteInterface $route, RequestContext $context);
}

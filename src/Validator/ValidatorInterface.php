<?php
namespace Slince\Router\Validator;

use Slince\Router\RouteInterface;
use Slince\Router\RequestContext;

interface ValidatorInterface
{

    function validate(RouteInterface $route, RequestContext $requestContext);
}

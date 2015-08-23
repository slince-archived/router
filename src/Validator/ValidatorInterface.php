<?php
/**
 * slince router library
 * @author Tao <taosikai@yeah.net>
 */
namespace Slince\Router\Validator;

use Slince\Router\RouteInterface;
use Slince\Router\RequestContext;

interface ValidatorInterface
{

    /**
     * 验证规则
     * @param RouteInterface $route
     * @param RequestContext $context
     */
    function validate(RouteInterface $route, RequestContext $context);
}

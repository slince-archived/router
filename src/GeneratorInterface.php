<?php
/**
 * slince router library
 * @author Tao <taosikai@yeah.net>
 */
namespace Slince\Router;

interface GeneratorInterface
{
    function generate(RouteInterface $route);
}
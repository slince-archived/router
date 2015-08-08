<?php
namespace Slince\Router;

interface GeneratorInterface
{
    function generate(RouteInterface $route);
}
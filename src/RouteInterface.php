<?php
namespace Slince\Router;

interface RouteInterface
{

    function getUri();

    function getParameters();

    function getRequirements();

    function getSchemes();

    function getMethods();
    
    function getDomain();
    
    function setDomain($domain);
    
    function setMethods(array $methods);
}
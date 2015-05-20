<?php
namespace Slince\Router;

interface RouteInterface
{
    function getParams();
    
    function getUri();
    
    function getName();
}
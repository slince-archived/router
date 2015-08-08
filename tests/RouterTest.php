<?php
use Slince\Router\RouterFactory;

class RouterTest extends \PHPUnit_Framework_TestCase
{
    function testRouter()
    {
        $router = RouterFactory::create();
        $routes = $router->getRoutes();
        $routes->http('/me', ['controller' => 'Users', 'action'=>'home']);
        $route = $router->match('/me');
        debug($route);
    }
}
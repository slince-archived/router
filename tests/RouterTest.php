<?php
use Slince\Router\Router;

class RouterTest
{
    function testRouter()
    {
        $router = new Router();
        $routes = $router->getRoutes();
        $routes->http('/me', ['controller' => 'Users', 'action'=>'home']);
    }
}
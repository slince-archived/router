<?php
use Slince\Router\Router;

class RouterTest
{
    function testRouter()
    {
        $router = new Router();
        $router->getRoutes()->delete($uri, $parameters);
    }
}
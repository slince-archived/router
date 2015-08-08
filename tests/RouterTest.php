<?php
use Slince\Router\RouterFactory;

class RouterTest extends \PHPUnit_Framework_TestCase
{
    function testRouter()
    {
        $router = RouterFactory::create();
        $routes = $router->getRoutes();
        $route1 = $routes->http('/users', ['controller' => 'Users', 'action'=>'index']);
        $route2 = $routes->http('/users/{id}', ['controller' => 'Users', 'action'=>'home'])
            ->setRequirements(['id'=>'\d+']);
        try {
            $route = $router->match('/users/2');
        } catch (\Exception $e) {
            throw $e;
//             var_dump($route1->getReport());exit;
        }
        print_r($route->getParameters());
    }
}
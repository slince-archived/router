<?php
use Slince\Router\RouterFactory;
use Slince\Router\RequestContext;
use Slince\Router\RouteCollection;

class RouterTest extends \PHPUnit_Framework_TestCase
{
    function testRouter()
    {
        $context = RequestContext::create();
        $context->setHost('m.baidu.com');
        $router = RouterFactory::create($context);
        $routes = $router->getRoutes();
        $routes->prefix('user', function(RouteCollection $routes){
            $route1 = $routes->http('/users', ['controller' => 'Users', 'action'=>'index']);
            $route2 = $routes->http('/users/{id}', ['controller' => 'Users', 'action'=>'home'])
                ->setRequirements(['id'=>'\d+', 'subdomain' => 'www|m'])
                ->setDomain('{subdomain}.baidu.com');
        });
        try {
            $route = $router->match('/user/users/2');
        } catch (\Exception $e) {
            throw $e;
//             var_dump($route1->getReport());exit;
        }
//         var_dump($route->getPrefix());
//         print_r($route->getCompiledRoute()->getStaticPrefix());
        print_r($route->getCompiledRoute()->getRegex());
//         print_r($route->getCompiledRoute()->getHostRegex());
//         print_r($route->getCompiledRoute()->getTokens());
//         print_r($route->getCompiledRoute()->getHostTokens());
//         print_r($route->getCompiledRoute()->getPathVariables());
//         print_r($route->getCompiledRoute()->getHostVariables());
//         print_r($route->getReport());
//         print_r($route->getCompiledRoute()->getVariables());exit;
//         print_r($route->getRouteParameters());
    }
}
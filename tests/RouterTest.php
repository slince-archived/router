<?php
use Slince\Router\RouterFactory;
use Slince\Router\RequestContext;
use Slince\Router\RouteCollection;

class RouterTest extends \PHPUnit_Framework_TestCase
{
    function testRouter()
    {
        $context = RequestContext::create();
        //$context->setHost('m.baidu.com');
        $router = RouterFactory::create($context);
        $routes = $router->getRoutes();
        $routes->http('/user2', [
            'name' => 'home.dash',
            'action' => 'UsersController@dashboard'
        ]);
        $routes->prefix('user', function(RouteCollection $routes){
            $routes->http('/users', 'UsersController@index');
            $routes->http('/users/{id}', 'UsersController@home')
                ->setRequirements(['id'=>'\d+', 'subdomain' => '((www|m).)?', 'maindomain'=>'baidu'])
                ->setDomain('{subdomain}{maindomain}.com');
            $routes->prefix('me', function (RouteCollection $routes) {
                $routes->http('/account', 'UsersController@me');
            });
        });
        try {
//             $route = $router->match('/user/users/2');
               $route = $router->match('/user/me/account');
        } catch (\Exception $e) {
            throw $e;
        }
            // var_dump($route->getPrefix());
            // print_r($route->getCompiledRoute()->getStaticPrefix());
            // print_r($route->getCompiledRoute()->getRegex());
            // print_r($route->getCompiledRoute()->getHostRegex());
            // print_r($route->getCompiledRoute()->getTokens());
            // print_r($route->getCompiledRoute()->getHostTokens());
            // print_r($route->getCompiledRoute()->getPathVariables());
            // print_r($route->getCompiledRoute()->getHostVariables());
            // print_r($route->getReport());
            // print_r($route->getCompiledRoute()->getVariables());exit;
            // print_r($route->getRouteParameters());exit;
//         echo $router->generate($route, ['id'=>'2', 'maindomain'=> 'baidu', 'ukey'=>1, 'type'=>3]);
            echo $router->generateByAction('/UsersController@dashboard', [], true);
            echo $router->generateByName('home.dash', ['a'=>'b'], true);
    }
}
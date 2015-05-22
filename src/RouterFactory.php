<?php
namespace Slince\Router;

use Aura\Router\RouterFactory;

class RouterFactory
{
    private $_router;
    
    static function newInstance()
    {
        if (! $this->_router instanceof RouterFactory) {
            $routerFactory = new RouterFactory;
            $this->_router = $routerFactory->newInstance();
        }
        return $this->_router;
    }
}
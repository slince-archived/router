<?php
namespace Slince\Router;

use Symfony\Component\Routing\RequestContext as SymfonyRequestContext;

class RequestContext extends SymfonyRequestContext
{
    static function create()
    {
        return new static();
    }
}
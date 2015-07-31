<?php
namespace Slince\Router;

class RouteCollection implements \Countable, \IteratorAggregate
{
    protected $_routes = [];
    
    protected $_subCollections = [];
    
    function __construct()
    {
        
    }
    
    function count()
    {
        
    }
}
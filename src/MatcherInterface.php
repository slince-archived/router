<?php
namespace Slince\Router;

use Slince\Router\Validator\ValidatorInterface;

interface MatcherInterface
{

    /**
     * 查找匹配的route
     *
     * @param string $path            
     * @param RouteCollection $routeCollection            
     * @return RouteInterface
     */
    function match($path, RouteCollection $routeCollection);

    /**
     * 设置 validator collection
     *
     * @param ValidatorCollection $validatorCollection            
     */
    function setValidators(ValidatorCollection $validatorCollection);
    
    /**
     * 获取validator collection
     *
     * @return ValidatorCollection
     */
    function getValidators();
    
    function setContext(RequestContext $context);
    
    function getContext();
}
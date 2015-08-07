<?php
namespace Slince\Router;

use Slince\Router\Validator\ValidatorInterface;
use Slince\Router\Validator\PathValidator;
use Slince\Router\Validator\MathodValidator;
use Slince\Router\Exception\RouteNotFoundException;

class Matcher implements MatcherInterface
{

    /**
     * request context
     * 
     * @var RequestContext
     */
    protected $_requestContext;

    /**
     * validator collection
     *
     * @var ValidatorCollection
     */
    protected $_validators;
    
    /**
     * route验证结果
     * 
     * @var array
     */
    protected $_report = [];

    function __construct(ValidatorCollection $validators = null, RequestContext $requestContext = null)
    {
        $this->_validators = $validators;
        $this->_requestContext = $requestContext;
    }

    /**
     * (non-PHPdoc)
     * 
     * @see \Slince\Router\MatcherInterface::match()
     */
    function match($path, RouteCollection $routes)
    {
        foreach ($routes as $route) 
        {
            if ($this->_validate($route)) {
                return $route;
            }
        }
        if (! empty($this->_report[MathodValidator::$id])) {
            $methods = [];
            $methods += array_map(function(RouteInterface $route) {
                return $route->getMethods();
            },$this->_report[MathodValidator::$id]);
            throw new MethodNotAllowedException(array_unique($methods));
        }
        throw new RouteNotFoundException();
    }

    function add($validator)
    {
        if ($validator instanceof \Closure) {
            $validator = ValidatorFactory::createCallbackValidator($validator);
        }
        $this->_validators->add($validator);
    }

    function getValidators()
    {
        return $this->_validators;
    }
    
    function setValidators(ValidatorCollection $validatorCollection)
    {
        $this->_validators = $validatorCollection;
    }
    
    function setRequestContext(RequestContext $requestContext)
    {
        $this->_requestContext = $requestContext;
    }
    
    function getRequestContext()
    {
        return $this->_requestContext;
    }
    
    /**
     * 验证route是否通过
     *
     * @param RouteInterface $route
     */
    protected function _validate($route)
    {
        foreach ($this->_validators as $validator) {
            if (! $validator->validator->validate($route, $this->_requestContext)) {
                $this->_writeReport($validator->id, $route);
                return false;
            }
        }
        return true;
    }
    protected function _writeReport($validatorId, RouteInterface $route)
    {
        if (is_null($this->_report[$validatorId])) {
            $this->_report[$validatorId] = [];
        }
        $this->_report[$validatorId][] =$route;
    }
}
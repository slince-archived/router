<?php
namespace Slince\Router;

use Slince\Router\Validator\ValidatorInterface;

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
        return false;
    }

    /**
     * 验证route是否通过
     * 
     * @param RouteInterface $route
     */
    protected function _validate($route)
    {
        foreach ($this->_validators as $validator) {
            if ($validator->validator->validate($route, $this->_requestContext)) {
                return false;
            }
        }
        return true;
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
}
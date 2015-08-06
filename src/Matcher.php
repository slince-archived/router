<?php
namespace Slince\Router;

use Slince\Router\Validator\ValidatorInterface;

class Matcher implements MatcherInterface
{

    /**
     * route collection
     *
     * @var RouteCollection
     */
    protected $_routeCollection;

    /**
     * validator collection
     *
     * @var ValidatorCollection
     */
    protected $_validatorCollection;

    function __construct(ValidatorCollection $validatorCollection = null)
    {
        $this->_validatorCollection = $validatorCollection;
    }

    /**
     * (non-PHPdoc)
     * 
     * @see \Slince\Router\MatcherInterface::match()
     */
    function match($path, RouteCollection $routeCollection)
    {
        $this->_routeCollection = $routeCollection;
    }

    function add($validator)
    {
        if ($validator instanceof \Closure) {
            $validator = ValidatorFactory::createCallbackValidator($validator);
        }
        $this->_validatorCollection->add($validator);
    }

    function getValidators()
    {
        return $this->_validatorCollection;
    }
    
    function setValidators(ValidatorCollection $validatorCollection)
    {
        $this->_validatorCollection = $validatorCollection;
    }
}
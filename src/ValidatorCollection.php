<?php
namespace Slince\Router;

use Slince\Router\Validator\ValidatorInterface;

class ValidatorCollection implements \Countable, \IteratorAggregate
{

    protected $_validators = [];

    function __construct(array $validators = [])
    {
        $this->_validators = $validators;
    }

    static function create($validators = [])
    {
        return new self($validators);
    }
    
    function replace(array $validators = [])
    {
        $this->_validators = $validators;
    }

    function add(ValidatorInterface $validator)
    {
        $this->_validators[] = $validator;
    }

    function merge($validators)
    {
        $this->_validators += $validators;
    }

    function delete(ValidatorInterface $validator)
    {
        if (($key = array_search($validator, $this->_validators)) !== false) {
            unset($this->_validators[$key]);
        }
    }

    function count()
    {
        return count($this->_validators);
    }

    function getIterator()
    {
        return new \ArrayIterator($this->_validators);
    }
}

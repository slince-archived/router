<?php
/**
 * slince router library
 * @author Tao <taosikai@yeah.net>
 */
namespace Slince\Router;

use Slince\Router\Validator\ValidatorInterface;

class ValidatorCollection implements \Countable, \IteratorAggregate
{

    /**
     * validators
     *
     * @var array
     */
    protected $_validators = [];

    function __construct(array $validators = [])
    {
        $this->_validators = $validators;
    }

    /**
     * 实例化当前对象
     * 
     * @param array $validators            
     * @return \Slince\Router\ValidatorCollection
     */
    static function create($validators = [])
    {
        return new static($validators);
    }

    /**
     * 更换当前validator集合
     * 
     * @param array $validators            
     */
    function replace(array $validators = [])
    {
        $this->_validators = $validators;
    }

    /**
     * 添加一个validator
     * 
     * @param ValidatorInterface $validator            
     */
    function add(ValidatorInterface $validator)
    {
        $this->_validators[] = $validator;
    }

    /**
     * 合并validators
     * 
     * @param array $validators            
     */
    function merge(array $validators)
    {
        $this->_validators += $validators;
    }

    /**
     * 删除一个validator
     * 
     * @param ValidatorInterface $validator            
     */
    function delete(ValidatorInterface $validator)
    {
        if (($key = array_search($validator, $this->_validators)) !== false) {
            unset($this->_validators[$key]);
        }
    }

    /**
     * (non-PHPdoc)
     * 
     * @see Countable::count()
     */
    function count()
    {
        return count($this->_validators);
    }

    /**
     * (non-PHPdoc)
     * 
     * @see IteratorAggregate::getIterator()
     */
    function getIterator()
    {
        return new \ArrayIterator($this->_validators);
    }
}

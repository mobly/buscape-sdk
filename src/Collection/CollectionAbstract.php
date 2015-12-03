<?php

namespace Mobly\Buscape\Sdk\Collection;

use Mobly\Buscape\Sdk\Entity\EntityAbstract;
use Mobly\Buscape\Sdk\Entity\Product;

/**
 * Class CollectionAbstract
 *
 * @package Mobly\Buscape\Sdk\Collection
 */
abstract class CollectionAbstract implements \IteratorAggregate, \JsonSerializable, \Countable
{
    /**
     * @var array
     */
    protected $collection = [];

    /**
     * @param EntityAbstract $abstractEntity
     * @param null $key
     */
    public function add(EntityAbstract $abstractEntity, $key = null)
    {
        if (is_null($key)) {
            $this->collection[] = $abstractEntity;
        } else {
            $this->collection[$key] = $abstractEntity;
        }
    }

    /**
     * Return count of collection
     *
     * @return integer
     **/
    public function count()
    {
        return count($this->collection);    
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        return $this->collection;
    }

    /**
     * Return array of collection
     *
     * @return array
     **/
    public function toArray()
    {
        return $this->collection;     
    }

    /**
     * @return \ArrayIterator
     */
    public function getIterator()
    {
        return new \ArrayIterator($this->collection);
    }

    /**
     * @return array
     */
    public function getErrors()
    {
        $errors = [];

        /** @var Product $item */
        foreach ($this->collection as $item) {
            if ($item->hasErrors()) {
                $errors[$item->getSku()] = $item->getErrors();
            }
        }

        return $errors;
    }
}

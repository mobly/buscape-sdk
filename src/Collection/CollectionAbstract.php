<?php

namespace Mobly\Buscape\Sdk\Collection;

use Mobly\Buscape\Sdk\Entity\EntityAbstract;

/**
 * Class CollectionAbstract
 *
 * @package Mobly\Buscape\Sdk\Collection
 */
abstract class CollectionAbstract implements \JsonSerializable, \Countable
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
}

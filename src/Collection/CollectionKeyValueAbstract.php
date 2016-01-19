<?php
namespace Mobly\Buscape\Sdk\Collection;

use Mobly\Buscape\Sdk\Entity\EntityKeyValueAbstract;

/**
 * Attribute collection class
 *
 * @package Mobly\Buscape\Sdk\Collection
 * @author Wilton Garcia <wilton.oliveira@mobly.com.br>, <wiltonog@gmail.com>
 **/
class CollectionKeyValueAbstract implements \IteratorAggregate, \JsonSerializable
{
    /**
     * @var array
     */
    protected $collection = [];

    /**
     * Add item in collection
     *
     * @param EntityKeyValueAbstract $entity
     * @return void
     */
    public function add(EntityKeyValueAbstract $entity)
    {
        $this->collection[$entity->getKey()] = $entity->getValue();
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


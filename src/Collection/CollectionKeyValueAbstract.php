<?php
namespace Mobly\Buscape\Sdk\Collection;

use Mobly\Buscape\Sdk\Entity\EntityKeyValueAbstract;

/**
 * Attribute collection class
 *
 * @package Mobly\Buscape\Sdk\Collection
 * @author Wilton Garcia <wilton.oliveira@mobly.com.br>, <wiltonog@gmail.com>
 **/
class CollectionKeyValueAbstract implements \JsonSerializable
{
    /**
     * @var array
     */
    protected $collection = [];

    /**
     * Add iten in collection  
     *
     * @param EntityKeyValueAbstract $entity
     * @return void
     */
    public function add(EntityKeyValueAbstract $entity) {
        $this->collection[] = $entity;
    }

    /**
     * @return array
     */
    public function jsonSerialize() {
        $data = [];
        foreach ($this->collection as $item) {
            $data[$item->getKey()] = $item->getValue();
        }
        return $data;
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


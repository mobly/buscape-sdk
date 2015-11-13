<?php

namespace Mobly\Buscape\Collection;

use Mobly\Buscape\Entity\EntityAbstract;

/**
 * Class Abstract
 * 
 * @package Mobly\Buscape\Collection
 */
class CollectionAbstract implements \JsonSerializable
{
    /**
     * @var array
     */
    protected $collection = [];

    /**
     * @param EntityAbstract $abstractEntity
     * @param null $key
     */
    public function add(EntityAbstract $abstractEntity, $key = null) {
        $this->collection[$key] = $abstractEntity;
    }

    /**
     * @return array
     */
    public function jsonSerialize() {
        $properties = get_object_vars($this);

        return $properties;
    }
}
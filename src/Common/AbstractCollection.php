<?php

namespace Mobly\Buscape\Common;

/**
 * Class AbstractCollection
 *
 * @package Mobly\Buscape\Common
 */
class AbstractCollection implements \JsonSerializable
{
    /**
     * @var array
     */
    protected $collection = [];

    /**
     * @param AbstractEntity $abstractEntity
     * @param null $key
     */
    public function add(AbstractEntity $abstractEntity, $key = null) {
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
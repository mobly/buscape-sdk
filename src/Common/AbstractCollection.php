<?php

namespace Mobly\Buscape\Common;

/**
 * Class AbstractCollection
 *
 * @package Mobly\Buscape\Common
 */
class AbstractCollection implements \JsonSerializable
{
    protected $collection = [];


    public function add(AbstractEntity $abstractEntity) {
        $this->collection[] = $abstractEntity;
    }

    /**
     * @return array
     */
    public function jsonSerialize() {
        $properties = get_object_vars($this);

        return $properties;
    }
}
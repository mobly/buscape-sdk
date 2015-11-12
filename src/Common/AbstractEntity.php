<?php

namespace Mobly\Buscape\Common;

/**
 * Class AbstractEntity
 *
 * @package Mobly\Buscape\Common
 */
class AbstractEntity implements \JsonSerializable
{

    /**
     * @return array
     */
    public function jsonSerialize() {
        $properties = get_object_vars($this);

        return $properties;
    }
}
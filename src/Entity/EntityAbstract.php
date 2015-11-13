<?php

namespace Mobly\Buscape\Entity;

/**
 * Class EntityAbstract
 *
 * @package Mobly\Buscape\Entity
 */
class EntityAbstract implements \JsonSerializable
{
    /**
     * AbstractEntity constructor.
     *
     * @param array $data
     */
    public function __construct($data = [])
    {
        $this->setData($data);
    }

    /**
     * @param $data
     */
    public function setData($data)
    {
        foreach ($data as $key => $value) {
            if (property_exists($this, $key)) {
                $this->{$key} = $value;
            }
        }
    }

    /**
     * @param $key
     * @param $value
     */
    public function createProperty($key, $value)
    {
        $this->{$key} = $value;
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        $properties = get_object_vars($this);

        return $properties;
    }
}
<?php

namespace Mobly\Buscape\Sdk\Entity;

/**
 * Class EntityAbstract
 *
 * @package Mobly\Buscape\Sdk\Entity
 */
abstract class EntityAbstract implements \JsonSerializable
{
    /**
     * @var array
     */
    protected $required = [];

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
     * @return array
     */
    public function toArray()
    {
        $properties = get_object_vars($this);

        $data = [];
        foreach ($properties as $property => $value) {
            if ($property == 'required') {

                continue;
            }

            if ($value instanceof EntityAbstract) {
                $data[$property] = $value->toArray();

                continue;
            }

            if ((is_array($value) && count($value)) || $value instanceof \IteratorAggregate) {
                foreach ($value as $index => $item) {
                    if ($item instanceof EntityAbstract) {
                        $data[$property][$index] = $item->toArray();
                    } else {
                        $data[$property][$index] = $item;
                    }
                }

                continue;
            }

            $data[$property] = $this->$property;
        }

        return $data;
    }

    /**
     * @param array|object $data
     *
     * @throws \Exception
     */
    protected function validateRequired($data)
    {
        if (is_object($data)) {
            $data = get_object_vars($data);
        }

        $missing = [];

        foreach ($this->required as $attribute) {
            if (!isset($data[$attribute])) {
                $missing[] = $attribute;
            }
        }

        if (count($missing) > 0) {
            throw new \Exception('Required params "' . implode(', ', $missing) . '" missing');
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
        return $this->toArray();
    }
}
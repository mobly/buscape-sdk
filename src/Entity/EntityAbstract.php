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
     * Define required proprieties
     *
     * @var array
     */
    protected $required = [];

    /**
     * Array with errors
     *
     * @var array
     */
    protected $errors = [];

    /**
     * @var boolean
     */
    protected $hasErrors;

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
            if ($property == 'required' ||
                $property == 'errors' ||
                $property == 'hasErrors') {
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
            $this->errors[] = 'Required params "' . implode(', ', $missing) . '" missing';
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

    /**
     * @return array
     */
    public function getRequired()
    {
        return $this->required;
    }

    /**
     * @param array $required
     */
    public function setRequired($required)
    {
        $this->required = $required;
    }

    /**
     * @return array
     */
    public function getErrors()
    {
        return $this->errors;
    }

    /**
     * @param array $errors
     */
    public function setErrors($errors)
    {
        $this->errors[] = $errors;
    }

    /**
     * @return bool
     */
    public function hasErrors()
    {
        return (bool) count($this->getErrors()) > 0;
    }

}
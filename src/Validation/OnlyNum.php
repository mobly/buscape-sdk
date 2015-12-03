<?php

namespace Mobly\Buscape\Sdk\Validation;

use Mobly\Buscape\Sdk\Entity\EntityAbstract;

class OnlyNum extends ValidationAbstract
{
    /**
     * Required constructor.
     *
     * @param $property
     * @param $param
     * @param EntityAbstract $entity
     */
    public function __construct($property, $param, EntityAbstract $entity)
    {
        $this->property = $property;
        $this->entity = $entity;
        $this->param = $param;
    }

    /**
     * Validate required param
     */
    public function validate()
    {
        $data = $this->entity->toArray();

        if (isset($data[$this->property]) && !preg_match('/^[0-9]+$/', $data[$this->property])) {
            $this->entity->setErrors(
                'The param "' . $this->property . '" must be numeric'
            );
        }

    }
}
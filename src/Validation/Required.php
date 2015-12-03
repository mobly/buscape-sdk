<?php

namespace Mobly\Buscape\Sdk\Validation;

use Mobly\Buscape\Sdk\Entity\EntityAbstract;

class Required
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

        if (!isset($data[$this->required])) {
            $this->entity->setErrors(
                'Required param "' . $this->required . '" missing'
            );
        }
    }
}
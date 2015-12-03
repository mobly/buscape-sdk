<?php

namespace Mobly\Buscape\Sdk\Validation;

use Mobly\Buscape\Sdk\Entity\EntityAbstract;

class MaxLength extends ValidationAbstract
{

    /**
     * MaxLength constructor.
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
     *
     */
    public function validate()
    {
        $data = $this->entity->toArray();

        $property = isset($data[$this->property]) ?
            $data[$this->property] : false;

        if (!$property) {
            return;
        }

        if (is_array($property)) {
            foreach ($property as $data) {
                if (strlen($data) > $this->param){
                    $this->entity->setErrors(
                        'Param "' . $this->property . '" bigger than '. $this->param . ' - ' . $data .' characters'
                    );
                }
            }
        } else {
            if (strlen($property) > $this->param){
                $this->entity->setErrors(
                    'Param "' . $this->property . '" bigger than '. $this->param . ' characters'
                );
            }
        }
    }
}
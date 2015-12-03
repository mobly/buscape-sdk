<?php

namespace Mobly\Buscape\Sdk\Validation;

use Mobly\Buscape\Sdk\Entity\EntityAbstract;

class AllowTags extends ValidationAbstract
{

    /**
     * @var array
     */
    protected $allowTags = [
        '<p>',
        '<br>',
        '<b>',
        '<strong>',
        '<i>',
        '<div>',
        '<span>',
    ];

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

        $property = isset($data[$this->property]) ? $data[$this->property] : false;

        if ($property && ($property != strip_tags($property, implode('', $this->allowTags)))) {
            $this->entity->setErrors(
                'The param "' . $this->property . '" has not allowed HTML tags'
            );
        }
    }
}
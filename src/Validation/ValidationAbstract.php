<?php

namespace Mobly\Buscape\Sdk\Validation;

use Mobly\Buscape\Sdk\Entity\EntityAbstract;

abstract class ValidationAbstract
{
    protected $property;

    protected $entity;

    protected $param;

    /**
     * ValidationAbstract constructor.
     *
     * @param $property
     * @param $param
     * @param EntityAbstract $entity
     */
    abstract public function __construct($property, $param, EntityAbstract $entity);

    /**
     * @return mixed
     */
    abstract public function validate();

}
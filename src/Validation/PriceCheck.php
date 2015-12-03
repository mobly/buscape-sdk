<?php

namespace Mobly\Buscape\Sdk\Validation;

use Mobly\Buscape\Sdk\Entity\EntityAbstract;
use Mobly\Buscape\Sdk\Entity\Product\Price;

class PriceCheck extends ValidationAbstract
{

    /**
     * @var array
     */
    protected $avista = [
        Price::TYPE_CARTAO_AVISTA,
        Price::TYPE_BOLETO
    ];

    /**
     * @var array
     */
    protected $parcelado = [
        Price::TYPE_CARTAO_PARCELADO_SEM_JUROS,
        Price::TYPE_CARTAO_PARCELADO_COM_JUROS
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

        if (is_array($property)) {
            $avistaCheck = [];
            $parceladoCheck = [];

            foreach ($property as $price) {
                if (in_array($price['type'], $this->avista)) {
                    $avistaCheck[] = $price['type'];
                }

                if (in_array($price['type'], $this->parcelado)) {
                    $parceladoCheck[] = $price['type'];
                }

                if (!count($avistaCheck) > 0 && !count($parceladoCheck) > 0) {
                    $this->entity->setErrors(
                        'The param "' . $this->property . '" must be defined with two prices avista and parcelado'
                    );
                }
            }
        } else {
            $this->entity->setErrors(
                'The param "' . $this->property . '" must be defined'
            );
        }
    }
}
<?php

namespace Mobly\Buscape\Sdk\Entity\Product;

use Mobly\Buscape\Sdk\Entity\EntityAbstract;

/**
 * Class Price
 * 
 * @package Mobly\Buscape\Sdk\Entity\Product
 */
class Price extends EntityAbstract
{
    /**
     * @const TYPE_BOLETO option boleto
     */
    const TYPE_BOLETO = 'boleto';

    /**
     * @const TYPE_CARTAO_AVISTA option cartao_avista
     */
    const TYPE_CARTAO_AVISTA = 'cartao_avista';

    /**
     * @const TYPE_CARTAO_PARCELADO_SEM_JUROS option cartao_parcelado_sem_juros
     */
    const TYPE_CARTAO_PARCELADO_SEM_JUROS = 'cartao_parcelado_sem_juros';

    /**
     * @const TYPE_CARTAO_PARCELADO_COM_JUROS option cartao_parcelado_com_juros
     */
    const TYPE_CARTAO_PARCELADO_COM_JUROS = 'cartao_parcelado_com_juros';

    /**
     * Type of price, options: boleto, cartao_avista,
     * cartao_parcelado_sem_juros, cartao_parcelado_com_juros
     *
     * @var string
     */
    protected $type;

    /**
     * Price of product to Buscapé
     *
     * @var float
     */
    protected $price;

    /**
     * Price of product to Lomadee
     *
     * @var float
     */
    protected $priceLomadee;

    /**
     * Quantity of installments
     *
     * @var int
     */
    protected $installment;

    /**
     * Price of installment
     *
     * @var float
     */
    protected $installmentValue;

    /**
     * Validation rules
     * @var array
     */
    protected $rules = [
        'type' => [
            'required'
        ],
        'price' => [
            'required'
        ]
    ];

    /**
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return float
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param float $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }

    /**
     * @return float
     */
    public function getPriceLomadee()
    {
        return $this->priceLomadee;
    }

    /**
     * @param float $priceLomadee
     */
    public function setPriceLomadee($priceLomadee)
    {
        $this->priceLomadee = $priceLomadee;
    }

    /**
     * @return int
     */
    public function getInstallment()
    {
        return $this->installment;
    }

    /**
     * @param int $installment
     */
    public function setInstallment($installment)
    {
        $this->installment = $installment;
    }

    /**
     * @return float
     */
    public function getInstallmentValue()
    {
        return $this->installmentValue;
    }

    /**
     * @param float $installmentValue
     */
    public function setInstallmentValue($installmentValue)
    {
        $this->installmentValue = $installmentValue;
    }

}
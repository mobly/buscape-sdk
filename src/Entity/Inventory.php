<?php

namespace Mobly\Buscape\Sdk\Entity;

use Mobly\Buscape\Sdk\Collection\Product\PriceCollection;

/**
 * Class Inventory
 *
 * @package Mobly\Buscape\Sdk\Entity
 */
class Inventory extends EntityAbstract
{
    /**
     * Product ID
     * 240 characters max.
     *
     * @var string
     */
    protected $sku;

    /**
     * Price list of product.
     * Need at least two prices
     * boleto or cartao_avista and cartao_parcelado_sem_juros or cartao_parcelado_com_juros
     *
     * @var PriceCollection
     */
    protected $prices;

    /**
     * Quantity of product in stock
     *
     * @var int
     */
    protected $quantity;

    /**
     * Errors of call
     *
     * @var array
     */
    protected $errors = [];

    /**
     * Status
     *
     * @var bool
     */
    protected $status;


    /**
     * Validation rules
     * @var array
     */
    protected $rules = [
        'sku' => [
            'required',
            'maxLength' => 240,
        ],
        'prices' => [
            'required',
            'priceCheck'
        ],
        'quantity' => [
            'required'
        ]
    ];

    /**
     * Product constructor.
     *
     * @param array $data
     */
    public function __construct($data = [])
    {
        parent::__construct($data);
    }

    /**
     * @return string
     */
    public function getSku()
    {
        return $this->sku;
    }

    /**
     * @param string $sku
     */
    public function setSku($sku)
    {
        $this->sku = $sku;
    }

    /**
     * @return array
     */
    public function getPrices()
    {
        return $this->prices;
    }

    /**
     * @param PriceCollection $prices
     */
    public function setPrices(PriceCollection $prices)
    {
        $this->prices = $prices;
    }

    /**
     * @return int
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * @param int $quantity
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
    }

    /**
     * @return bool
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param bool $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

}
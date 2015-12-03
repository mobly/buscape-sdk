<?php

namespace Mobly\Buscape\Sdk\Collection\Product;

use Mobly\Buscape\Sdk\Collection\CollectionAbstract;
use Mobly\Buscape\Sdk\Entity\EntityAbstract;

/**
 * Class Price
 *
 * @package Mobly\Buscape\Sdk\Collection\Product
 */
class PriceCollection extends CollectionAbstract
{
    /**
     * @var array
     */
    protected  $errors = [];

    /**
     * @param EntityAbstract $price
     * @param null $key
     */
    public function add(EntityAbstract $price, $key = null)
    {
        if ($price->isValid()) {
            $this->collection[] = $price;
        } else {
            $this->errors[] = $price;
        }
    }
}
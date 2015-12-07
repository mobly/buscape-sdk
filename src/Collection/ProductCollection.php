<?php

namespace Mobly\Buscape\Sdk\Collection;

use Mobly\Buscape\Sdk\Entity\EntityAbstract;
use Mobly\Buscape\Sdk\Entity\Product;

class ProductCollection extends CollectionAbstract
{
    /**
     * @var array
     */
    protected $errors = [];

    /**
     * @param EntityAbstract $product
     * @param null $key
     */
    public function add(EntityAbstract $product, $key = null)
    {
        if ($product->isValid()) {
            $this->collection[] = $product;
        } else {
            $this->errors[$product->getSku()] = $product->getErrors();
        }
    }

    /**
     * @return array
     */
    public function getErrors()
    {
        return array_merge(
            $this->errors,
            parent::getErrors()
        );
    }

}
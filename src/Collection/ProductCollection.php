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
     * @var array
     */
    protected $success = [];

    /**
     * @param EntityAbstract $product
     * @param null $key
     */
    public function add(EntityAbstract $product, $key = null)
    {
        if ($product->isValid()) {
            $this->collection[] = $product;
        } else {
            $this->addErrors($product);
        }
    }

    public function addResponse(EntityAbstract $product)
    {
        if ($product->isValid()) {
            $this->success[] = $product->getSku();
        } else {
            $this->addErrors($product);
        }
    }

    /**
     * @param EntityAbstract $product
     */
    protected function addErrors(EntityAbstract $product)
    {
        $this->errors[$product->getSku()] = $product->getErrors();
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

    public function getSuccess()
    {
        return $this->success;
    }
}
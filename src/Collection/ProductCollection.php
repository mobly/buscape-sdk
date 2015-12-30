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
    protected $response = [];

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
     * @param EntityAbstract $product
     */
    public function addResponse(EntityAbstract $product)
    {
        $errors = $product->getErrors();
        $this->response[$product->getSku()] = [
            'status' => (bool) $product->isValid(),
            'errors' => count($errors) ? array_shift($errors) : null
        ];
    }

    /**
     * @return mixed
     */
    public function getResponse()
    {
        return $this->response;
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
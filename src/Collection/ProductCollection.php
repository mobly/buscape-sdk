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

    const PARTNER_VALIDATION_ERROR = 'PV';
    const INTERNAL_VALIDATION_ERROR = 'IV';

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
    public function addProductResponse(EntityAbstract $product)
    {
        $errors = $product->getErrors();

        $arrayDetails = [
            'status' => (bool) $product->isValid()
        ];

        if (count($errors)) {
            $arrayDetails['errors'] = [
                'origin' => self::PARTNER_VALIDATION_ERROR,
                'messages' => array_shift($errors)
            ];
        }

        $this->response[$product->getSku()] = $arrayDetails;
    }

    /**
     * @param $errors
     */
    public function addValidationResponse($errors)
    {
        foreach ($errors as $sku => $messages) {
            $arrayDetails = [
                'status' => false,
                'errors' => [
                    'origin' => self::INTERNAL_VALIDATION_ERROR,
                    'messages' => $messages
                ]
            ];

            $this->response[$sku] = $arrayDetails;
        }
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
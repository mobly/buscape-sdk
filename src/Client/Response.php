<?php

namespace Mobly\Buscape\Sdk\Client;

use Mobly\Buscape\Sdk\Collection\ProductCollection;

/**
 * Response
 *
 * @package Mobly\Buscape\Sdk\Client
 * @author Wilton Garcia <wilton.oliveira@mobly.com.br>, <wiltonog@gmail.com>
 **/
class Response 
{
    /**
     * Response status
     *
     * @var boolean
     **/
    protected $status;

    /**
     * Response data
     *
     * @var Mobly\Buscape\Sdk\Collection\Product
     **/
    protected $data;

    /**
     * Response message
     *
     * @var string
     **/
    protected $message;

    /**
     * Class constructor
     *
     * @param boolean|null $status
     * @param Mobly\Buscape\Sdk\Collection\Product|null $data
     * @param string|null $message
     * @return void
     **/
    public function __construct(
        $status = null, 
        $data = null, 
        $message = null
    )
    {
        $this->status = $status;
        $this->data = $data;
        $this->message = $message;  
    }

    /**
     * Return ths status of response
     *
     * @return boolean
     **/
    public function getStatus()
    {
        return $this->status;    
    }

    /**
     * Set the status of response
     *
     * @param boolean|null $status
     * @return void
     **/
    public function setStatus($status)
    {
        $this->status = $status;    
    }

    /**
     * Return the data of response
     *
     * @return Mobly\Buscape\Sdk\Collection\Product|null 
     **/
    public function getData()
    {
        return $this->data;    
    }

    /**
     * Set the data of response
     *
     * @param Mobly\Buscape\Sdk\Collection\Product $data
     * @return void
     **/
    public function setData(ProductCollection $data)
    {
        $this->data = $data;
    }

    /**
     * Return the message of response
     *
     * @return string
     **/
    public function getMessage()
    {
        return $this->message;    
    }

    /**
     * Set the message of response
     *
     * @param string $message
     * @return void
     **/
    public function setMessage($message)
    {
        $this->message = $message;    
    }

    /**
     * Merge data from Buscape with the ccollection of products and set the this data property
     *
     * @param ProductCollection $products
     * @param $responseData
     */
    public function mergeData(ProductCollection $products, $responseData)
    {
        $this->data = new ProductCollection();

        if (empty($responseData) && $products->getErrors()) {
            $this->data->addValidationResponse($products->getErrors());
            return;
        }

        foreach ($products as $key => $product) {
            if (empty($responseData[$key])) {
                continue;
            }

            if (!empty($responseData[$key]['status'])) {
                $product->setStatus($responseData[$key]['status']);
            }
            if (!empty($responseData[$key]['errors'])) {
                $product->setErrors($responseData[$key]['errors']);    
            }

            $this->data->addProductResponse($product);
        }    
    }
}


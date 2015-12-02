<?php

namespace Mobly\Buscape\Tests\Mocks\Traits;

use Mobly\Buscape\Sdk\Client\Request\Paginator;
use Mobly\Buscape\Sdk\Client\Response;
use Mobly\Buscape\Sdk\Collection\Product as ProductCollection;
use Mobly\Buscape\Sdk\Entity\Product;

/**
 * Trait for Mock data from ProductCollection
 *
 * @package Mobly\Buscape\Tests\Mocks\Traits
 * @author Wilton Garcia <wilton.oliveira@mobly.com.br>, <wiltonog@gmail.com>
 **/
trait ProductCollectionTrait
{
    /**
     * total items
     *
     * @var integer
     **/
    protected $totalItems = 2000;

    /**
     * Return a mock of the ProductCollection
     *
     * @return Mobly\Buscape\Sdk\Collection\Product
     **/
    protected function getCollection()
    {
        $collection = new ProductCollection();

        for ($i = 0; $i < $this->totalItems; $i++) {
            $product = new Product();
            $product->setGroupId($i);
            $product->setSku(uniqid($i));
            $collection->add($product);
        }
            
        return $collection;
    }

    /**
     * Expected data for Request
     *
     * @param  Mobly\Buscape\Sdk\Collection\Product $collection
     * @param  integer $chunk
     * @return array
     **/
    protected function getRequestExpected(
        ProductCollection $collection, 
        $chunk
    )
    {
        $paginator = new Paginator(
            $collection->toArray(),
            $chunk
        );

        $response = [];
        foreach ($paginator as $page) {
            $code = 0;
            foreach ($page as $key => $productEntity) {
                $product = $productEntity->toArray();
                $error = 0 == $key || $key % 2;
                $tmp = [
                    'sku' => $product['sku'],
                    'status' => $error,
                ];
                if (!$error) {
                    $tmp['errors'][] = [
                        'code' => $code,
                        'message' => 'error message no. ' . $code
                    ];
                    $code++;
                }
                $response[] = $tmp;
            }    
        }

        return $response;
    }

    /**
     * Expected data for Response
     *
     * @param  Mobly\Buscape\Sdk\Collection\Product $collection
     * @param  integer $chunk
     * @return Mobly\Buscape\Sdk\Collection\Product
     **/
    public function getResponseExpected(
        ProductCollection $collection, 
        $chunk
    )
    {
        $response =  new Response();

        $response->mergeData(
            $collection,
            $this->getRequestExpected($collection, $chunk)
        );

        return $response;
    }

}

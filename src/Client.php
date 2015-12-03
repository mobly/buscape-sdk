<?php
namespace Mobly\Buscape\Sdk;

use Mobly\Buscape\Sdk\Client\Configuration;
use Mobly\Buscape\Sdk\Client\Request;
use Mobly\Buscape\Sdk\Client\Response;
use Mobly\Buscape\Sdk\Collection\ProductCollection;

/**
 * Client class
 *
 * @package Mobly\Buscape\Sdk
 * @author Fernando Lira <fernando.lira@mobly.com.br>
 * @author Wilton Garcia <wilton.oliveira@mobly.com.br>
 */
class Client
{
    /**
     * Class constructor
     * 
     * @param array $configuration
     * @return void
     **/
    public function __construct(array $configuration)
    {
        $this->configuration = Configuration::getInstance();    
    }

    /**
     * Load Products
     *
     * @param Mobly\Buscape\Sdk\Collection\Product $products
     * @return void
     **/
    public function loadProducts(ProductCollection $products)
    {
        $endpoint = $this->configuration->getEndpoint(
            Configuration::ENDPOINT_COLLECTION
        );
        
        $request = new Request($endpoint, $products);
        $response =  new Response();

        $response->mergeData(
            $products,
            $request->send()
        );

        return $response;
    }

    /**
     * Inventory Update
     *
     * @param Mobly\Buscape\Sdk\Collection\Product $products
     * @return void
     **/
    public function inventoryUpdate(ProductCollection $products)
    {
        $endpoint = $this->configuration->getEndpoint(
            Configuration::ENDPOINT_INVENTORY
        );
        
        $request = new Request($endpoint, $products);
        $response =  new Response();

        $response->mergeData(
            $products,
            $request->send()
        );

        return $response;
    }
}
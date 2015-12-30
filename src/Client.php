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
 *
 * @author Fernando Lira <fernando.lira@mobly.com.br>
 * @author Wilton Garcia <wilton.oliveira@mobly.com.br>
 * @author Mangierre Martins <mangierre.martins@mobly.com.br>
 * @author Rodrigo Pereira <rodrigo.pereira@mobly.com.br>
 *
 */
class Client
{
    /**
     * Client constructor.
     * @param array $configuration
     */
    public function __construct(array $configuration)
    {
        $this->configuration = new Configuration($configuration);
    }

    /**
     * Load Products
     *
     * @param ProductCollection $products
     *
     * @return Response
     */
    public function loadProducts(ProductCollection $products)
    {
        $endpoint = $this->configuration->getEndpoint(
            Configuration::ENDPOINT_COLLECTION
        );
        
        $request = new Request($endpoint, $products, $this->configuration);
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
     * @param ProductCollection $products
     *
     * @return Response
     */
    public function inventoryUpdate(ProductCollection $products)
    {
        $endpoint = $this->configuration->getEndpoint(
            Configuration::ENDPOINT_INVENTORY
        );
        
        $request = new Request($endpoint, $products, $this->configuration);
        $response =  new Response();

        $response->mergeData(
            $products,
            $request->send()
        );

        return $response;
    }
}

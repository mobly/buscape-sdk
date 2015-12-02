<?php

namespace Mobly\Buscape\Tests;

use Mobly\Buscape\Sdk\Client;
use Mobly\Buscape\Sdk\Client\Configuration;
use Mobly\Buscape\Sdk\Collection\Product as ProductCollection;
use Mobly\Buscape\Tests\Mocks\Traits\ProductCollectionTrait;

/**
 * Unit tests for Client
 *
 * @package Mobly\Buscape\Tests
 * @author Wilton Garcia <wilton.oliveira@mobly.com.br>, <wiltonog@gmail.com>
 **/
class ClientTest extends \PHPUnit_Framework_TestCase 
{
    /* @see Mobly\Buscape\Tests\Mocks\Traits\ProductCollectionTrait */
    use ProductCollectionTrait;

    /**
     * Client instance
     *
     * @var Mobly\Buscape\Sdk\Client
     **/
    protected $client;

    /**
     * Initialize the configuration property
     *
     * @return void
     **/
    public function setUp()
    {
        $this->client = new Client([]);
        $this->configuration = Configuration::getInstance();
    }

    /**
     * Test of the configuration setup method
     *
     * @return void
     **/
    public function testClient()
    {
        $this->assertInstanceOf('Mobly\Buscape\Sdk\Client', $this->client);
    }

    /**
     * Test for the endpoints
     *
     * @param string $endpointClass
     * @param string $method
     * @return void
     * @dataProvider provider
     **/
    public function testEndpoints($endpointClass, $method, $totalItems)
    {
        $this->totalItems = $totalItems;
        $endpoint = $this->configuration->getEndpoint(
            $endpointClass
        );
        $collection = $this->getCollection();

        $response = $this->client->$method($collection);

        $this->assertInstanceOf(
            'Mobly\Buscape\Sdk\Client\Response', 
            $response
        );

        $this->assertEquals(null, $response->getStatus());
        $this->assertEquals(null, $response->getMessage());
        $this->assertEquals(
            $this->getResponseExpected(
                $collection, 
                $endpoint->chunk
            )->getData(), 
            $response->getData()
        );

            
    }

    /**
     * Data provider for test of the endpoints
     *
     * @return array
     **/
    public function provider()
    {
        return [
            [
                Configuration::ENDPOINT_COLLECTION,
                'loadProducts',
                1001        
            ],
            [
                Configuration::ENDPOINT_INVENTORY,
                'inventoryUpdate',
                100        
            ]
        ];
    }
}

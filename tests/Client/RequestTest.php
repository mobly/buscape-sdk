<?php

namespace Mobly\Buscape\Tests\Client;

use Mobly\Buscape\Sdk\Client\Configuration;
use Mobly\Buscape\Sdk\Client\Request;
use Mobly\Buscape\Tests\Mocks\Traits\ProductCollectionTrait;

/**
 * Unit tests for Request
 *
 * @package Mobly\Buscape\Tests\Client
 * @author Wilton Garcia <wilton.oliveira@mobly.com.br>, <wiltonog@gmail.com>
 **/
class RequestTest extends \PHPUnit_Framework_TestCase 
{
    /* @see Mobly\Buscape\Tests\Mocks\Traits\ProductCollectionTrait */
    use ProductCollectionTrait;

    /**
     * Configuration instance
     *
     * @var \Mobly\Buscape\Sdk\Client\Configuration
     **/
    public $configuration;

    /**
     * Initialize the configuration property
     *
     * @return void
     **/
    public function setUp()
    {
        $this->configuration = new Configuration([]);
    }

    /**
     * Test of Request
     *
     * @return void
     **/
    public function testRequest()
    {
        $endpoint = $this->configuration->getEndpoint(
            Configuration::ENDPOINT_COLLECTION
        );
        $collection = $this->getCollection();
        $request = new Request($endpoint, $collection, $this->configuration);
        $response = $request->send();

        $expected = $this->getRequestExpected(
            $collection,
            $endpoint->chunk
        ); 

        $this->assertEquals(
            $expected, 
            $response
        );
    }

}

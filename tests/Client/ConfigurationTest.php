<?php
namespace Mobly\Buscape\Tests\Client;

use Mobly\Buscape\Sdk\Client\Configuration;

/**
 * Unit tests for Configuration
 *
 * @package Mobly\Buscape\Tests\Client
 * @author Wilton Garcia <wilton.oliveira@mobly.com.br>, <wiltonog@gmail.com>
 **/
class ConfigurationTest extends \PHPUnit_Framework_TestCase 
{
    /**
     * Configuration instance
     *
     * @var Mobly\Buscape\Sdk\Client\Configuration
     **/
    public $configuration;

    /**
     * Initialize the configuration property
     *
     * @return void
     **/
    public function setUp()
    {
        $this->configuration = Configuration::getInstance();
    }


    /**
     * Test of the configuration setup method
     *
     * @return void
     **/
    public function testConfigurationSetup()
    {
        $configurationTwo = Configuration::getInstance();
            
        $this->configuration->setup([
            'appToken' => '123123',
            'authToken' => '456456',
        ]);

        $this->assertEquals(
            '123123',
            $configurationTwo->appToken
        );

        $this->assertEquals(
            '456456',
            $configurationTwo->authToken
        );
    }    

    /**
     * Test of getEndpoint method for the Collection endpoint
     *
     * @return void
     **/
    public function testGetUrlFromEndpointCollection()
    {
        $endpoint = $this->configuration->getEndpoint(
            Configuration::ENDPOINT_COLLECTION
        );

        $expected = 'http://api.buscape.com.br/product/t1/collection';   

        $this->assertEquals(
            $expected,
            $endpoint->getUrl()
        );
    }
    
    /**
     * Test of getEndpoint method for the  Inventory endpoint
     *
     * @return void
     **/
    public function testGetUrlFromEndpointInventory()
    {
        $endpoint = $this->configuration->getEndpoint(
            Configuration::ENDPOINT_INVENTORY
        );
        
        $expected = 'http://api.buscape.com.br/product/t1/inventory';   
        
        $this->assertEquals(
            $expected,
            $endpoint->getUrl()
        );
    }
    
    /**
     * Test of getEndpoint method for the Collection endpoint if Sandbox mode on
     *
     * @return void
     **/
    public function testGetUrlFromEndpointCollectionIfSandboxModeOn()
    {
        $this->configuration->setup([
            'sandboxMode' => true,
        ]);

        $endpoint = $this->configuration->getEndpoint(
            Configuration::ENDPOINT_COLLECTION
        );

        $expected = 'http://sandbox-api.buscape.com.br/product/t1/collection';   

        $this->assertEquals(
            $expected,
            $endpoint->getUrl()
        );
    }
    
    /**
     * Test of getEndpoint method for the  Inventory endpoint if Sandbox mode on
     *
     * @return void
     **/
    public function testGetUrlFromEndpointInventoryIfSandboxModeOn()
    {
        $this->configuration->setup([
            'sandboxMode' => true,
        ]);

        $endpoint = $this->configuration->getEndpoint(
            Configuration::ENDPOINT_INVENTORY
        );
        
        $expected = 'http://sandbox-api.buscape.com.br/product/t1/inventory';   
        
        $this->assertEquals(
            $expected,
            $endpoint->getUrl()
        );
    }

}

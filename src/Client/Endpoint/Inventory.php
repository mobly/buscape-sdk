<?php

namespace Mobly\Buscape\Sdk\Client\Endpoint;

/**
 * Inventory endpoint
 *
 * @package Mobly\Buscape\Sdk\Client\Endpoint
 * @author Wilton Garcia <wilton.oliveira@mobly.com.br>, <wiltonog@gmail.com>
 **/
class Inventory extends EndpointAbstract
{
    /**
     * Singleton class instance
     *
     * @var Mobly\Buscape\Sdk\Client\Endpoint\Collection 
     **/
    private static $instance;

    /**
     * Endpoint sufix
     *
     * @var string
     **/
    protected $endpoint = '/product/t1/inventory';

    /**
     * HTTP Method
     *
     * @var string
     **/
    protected $method = 'PUT';

    /**
     * Number of items for send to endpoint
     *
     * @var integer
     **/
    protected $chunk = 1;

    /**
     * Create and return the instance of this class
     *
     * @return \Mobly\Buscape\Sdk\Client\Endpoint\Collection
     **/
    public static function getInstance()
    {
        if (null === static::$instance) {
            static::$instance = new static();
        }
        return static::$instance;    
    }    
}


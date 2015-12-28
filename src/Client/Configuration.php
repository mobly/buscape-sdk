<?php

namespace Mobly\Buscape\Sdk\Client;

use Mobly\Buscape\Sdk\Client\Endpoint\Collection;
use Mobly\Buscape\Sdk\Client\Endpoint\Inventory;

/**
 * Configuration class
 *
 * @package Mobly\Buscape\Sdk\Client
 * @author Wilton Garcia <wilton.oliveira@mobly.com.br>, <wiltonog@gmail.com>
 **/
class Configuration 
{
    /**
     * Collection endpoint name
     *
     * @var string
     **/
    const ENDPOINT_COLLECTION = 'Collection';

    /**
     * Inventory endpoint name
     *
     * @var string
     **/
    const ENDPOINT_INVENTORY = 'Inventory';
    
    /**
     * Singleton class instance
     *
     * @var Mobly\Buscape\Sdk\Client\Configuration
     **/
    private static $instance;

    /**
     * HTTP protocol
     *
     * @var string
     **/
    protected $protocol = 'http';

    /**
     * Host
     *
     * @var string
     **/
    protected $host = 'api.buscape.com.br';

    /**
     * Sandbox prefix
     *
     * @var string
     **/
    protected $sandboxPrefix = 'sandbox-';

    /**
     * Sandbox mode on|off
     *
     * @var bool
     **/
    protected $sandboxMode = false;

    /**
     * Application token
     *
     * @var string
     **/
    protected $appToken;

    /**
     * Authentication token
     *
     * @var string
     **/
    protected $authToken;


    /**
     * Configuration constructor.
     * @param array $configuration
     */
    protected function __construct(array $configuration)
    {
        $this->setup($configuration);
    }

    /**
     * Setup configuration
     *
     * @param array $configuration
     * @return void
     **/
    public function setup(array $configuration)
    {
        $properties = get_object_vars($this);
        $configurationKeys = array_keys($configuration);
        foreach ($properties as $property => $value) {
            if (in_array($property, $configurationKeys)) {
                $this->$property =  $configuration[$property];
            }
        }
    }

    /**
     * Return the endpoint object
     *
     * @param string $endpoint
     * @return Mobly\Buscape\Sdk\Client\Endpoint\Collection|Mobly\Buscape\Sdk\Client\Endpoint\Inventory
     **/
    public function getEndpoint($endpoint)
    {
        return call_user_func([
            __NAMESPACE__ . '\\Endpoint\\' . $endpoint, 
            'getInstance'
        ]);        
    }
    
    /**
     * Magic method for enable visibility to protected properties
     *
     * @link http://php.net/manual/pt_BR/language.oop5.overloading.php#language.oop5.overloading.members
     * @param $name
     *
     * @return mixed
     */
    public function __get($name)
    {
        return $this->$name;    
    }

    /**
     * Create and return the instance of this class
     *
     * @param array $configuration
     *
     * @return Mobly\Buscape\Sdk\Client\Configuration
     */
    public static function getInstance(array $configuration)
    {
        if (null === static::$instance) {
            static::$instance = new static($configuration);
        }
        return static::$instance;    
    }
    
}

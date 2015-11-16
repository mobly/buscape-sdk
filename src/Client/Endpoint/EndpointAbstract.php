<?php
namespace Mobly\Buscape\Sdk\Client\Endpoint;

use Mobly\Buscape\Sdk\Client\Configuration;

/**
 * Abstract endpoint class
 *
 * @package Mobly\Buscape\Sdk\Client\Endpoint
 * @author Wilton Garcia <wilton.oliveira@mobly.com.br>, <wiltonog@gmail.com.br>
 **/
abstract class EndpointAbstract
{
    /**
     * Content type header information 
     *
     * @var string
     **/
    protected $contentType = 'application/json';    

    /**
     * Accept header information
     *
     * @var string
     **/
    protected $accept = 'application/json';
    
    /**
     * Return the url for this endpoint
     *
     * @return string
     **/
    public function getUrl()
    {
        $configuration = Configuration::getInstance();
        return $configuration->protocol
            . '://'
            . ($configuration->sandboxMode ? $configuration->sandboxPrefix : '')
            . $configuration->host
            . $this->endpoint;
    }
    
    /**
     * Magic method for enable visibility to protected properties
     *
     * @link http://php.net/manual/pt_BR/language.oop5.overloading.php#language.oop5.overloading.members
     * @return string
     **/
    public function __get($name)
    {
        return $this->$name;    
    }

    /**
     * Class constructor
     *
     * @return void
     **/
    protected function __construct()
    {
    }  
}

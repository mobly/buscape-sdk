<?php
namespace Mobly\Buscape\Sdk\Entity\Product;

use Mobly\Buscape\Sdk\Entity\EntityAbstract;

/**
 * Attribute entity class
 *
 * @packaged Mobly\Buscape\Sdk\Entity\Product
 * @author Wilton Garcia <wilton.oliveira@mobly.com.br>, <wiltonog@gmail.com>
 **/
class Attribute extends EntityAbstract  
{
    /**
     * Attribute key
     *
     * @var string|integer
     **/
    protected $key;

    /**
     * Attribute value
     *
     * @var mixed
     **/
    protected $value;

    /**
     * Return the attribute key
     *
     * @return string|integer
     **/
    public function getKey()
    {
        return $this->key;    
    }
    
    /**
     * Set the attribute key
     *
     * @param string $key
     * @return void
     **/
    public function setKey($key)
    {
        $this->key = $key;    
    }
    
    /**
     * Return the attribute value
     *
     * @return mixed
     **/
    public function getValue()
    {
        return $this->value;    
    }

    /**
     * Set the attribute value
     *
     * @param mixed $value
     * @return void
     **/
    public function setValue($value)
    {
        $this->value = $value;    
    }
    
}


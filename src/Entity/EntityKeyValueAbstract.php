<?php
namespace Mobly\Buscape\Sdk\Entity;

use Mobly\Buscape\Sdk\Entity\EntityAbstract;

/**
 * Attribute entity class
 *
 * @packaged Mobly\Buscape\Sdk\Entity\Product
 * @author Wilton Garcia <wilton.oliveira@mobly.com.br>, <wiltonog@gmail.com>
 **/
class EntityKeyValueAbstract extends EntityAbstract  
{
    /**
     * Key
     *
     * @var string|integer
     **/
    protected $key;

    /**
     * Value
     *
     * @var mixed
     **/
    protected $value;

    /**
     * Return the key
     *
     * @return string|integer
     **/
    public function getKey()
    {
        return $this->key;    
    }
    
    /**
     * Set the key
     *
     * @param string $key
     * @return void
     **/
    public function setKey($key)
    {
        $this->key = $key;    
    }
    
    /**
     * Return the value
     *
     * @return mixed
     **/
    public function getValue()
    {
        return $this->value;    
    }

    /**
     * Set the value
     *
     * @param mixed $value
     * @return void
     **/
    public function setValue($value)
    {
        $this->value = $value;    
    }
    
}



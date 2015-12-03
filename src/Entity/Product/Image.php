<?php
namespace Mobly\Buscape\Sdk\Entity\Product;

use Mobly\Buscape\Sdk\Entity\EntityAbstract;

/**
 * Image entity class
 *
 * @package Mobly\Buscape\Sdk\Entity\Product
 * @author Wilton Garcia <wilton.oliveira@mobly.com.br>, <wiltonog@gmail.com>
 **/
class Image extends EntityAbstract  
{
    /**
     * Image URL (max: 4094 characters)
     *
     * @var string
     **/
    protected $url;

    /**
     * Return the URL string
     *
     * @return string
     **/
    public function getUrl()
    {
        return $this->url;    
    }

    /**
     * Set the URL string  
     *
     * @param string $url
     * @return void
     **/
    public function setUrl($url)
    {
        $this->url = $url;    
    }
    
    /**
     * Validation rules
     * @var array
     */
    protected $rules = [
        'url' => [
            'required',
            'maxLength' => 4094,
        ],
    ];
    
}

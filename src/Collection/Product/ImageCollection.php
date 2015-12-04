<?php
namespace Mobly\Buscape\Sdk\Collection\Product;

use Mobly\Buscape\Sdk\Collection\CollectionAbstract;
use Mobly\Buscape\Sdk\Entity\EntityAbstract;

/**
 * Image collection class
 *
 * @package Mobly\Buscape\Sdk\Collection\Product
 * @author Wilton Garcia <wilton.oliveira@mobly.com.br>, <wiltonog@gmail.com>
 **/
class ImageCollection extends CollectionAbstract
{
    /**
     * @var array
     */
    protected $collection = [];

    /**
     * Add item in image collection
     *
     * @param EntityAbstract $image
     * @param null $key
     * @return void
     */
    public function add(EntityAbstract $image, $key = null) {
        $this->collection[] = $image->getUrl();
    }
}

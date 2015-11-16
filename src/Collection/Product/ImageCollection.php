<?php
namespace Mobly\Buscape\Sdk\Collection\Product;

use Mobly\Buscape\Sdk\Entity\Product\Image;

/**
 * Image collection class
 *
 * @package Mobly\Buscape\Sdk\Collection\Product
 * @author Wilton Garcia <wilton.oliveira@mobly.com.br>, <wiltonog@gmail.com>
 **/
class ImageCollection implements \JsonSerializable
{
    /**
     * @var array
     */
    protected $collection = [];

    /**
     * Add iten in image collection  
     *
     * @param Image $image
     * @return void
     */
    public function add(Image $image) {
        $this->collection[] = $image->getUrl();
    }

    /**
     * @return array
     */
    public function jsonSerialize() {
        $properties = get_object_vars($this);

        return $properties['collection'];
    }
}

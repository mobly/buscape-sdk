<?php
namespace Mobly\Buscape\Sdk\Collection\Product;

use Mobly\Buscape\Sdk\Entity\Product\Attribute;

/**
 * Attribute collection class
 *
 * @package Mobly\Buscape\Sdk\Collection\Product
 * @author Wilton Garcia <wilton.oliveira@mobly.com.br>, <wiltonog@gmail.com>
 **/
class AttributeCollection implements \JsonSerializable
{
    /**
     * @var array
     */
    protected $collection = [];

    /**
     * Add iten in attribute collection  
     *
     * @param Attribute $attribute
     * @return void
     */
    public function add(Attribute $attribute) {
        $this->collection[] = $attribute;
    }

    /**
     * @return array
     */
    public function jsonSerialize() {
        $data = [];
        foreach ($this->collection as $item) {
            $data[$item->getKey()] = $item->getValue();
        }
        return $data;
    }
}

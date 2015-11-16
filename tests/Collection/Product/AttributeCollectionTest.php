<?php
namespace Mobly\Buscape\Tests\Collection\Product;

use Mobly\Buscape\Sdk\Collection\Product\AttributeCollection;
use Mobly\Buscape\Sdk\Entity\Product\Attribute;

/**
 * Unit tests for AttributeCollection
 *
 * @package Mobly\Buscape\Tests\Collection\Product
 * @author Wilton Garcia <wilton.oliveira@mobly.com.br>, <wiltonog@gmail.com>
 **/
class AttributeCollectionTest extends \PHPUnit_Framework_TestCase 
{
    /**
     * Test of the add method
     *
     * @return void
     **/
    public function testAttributeCollectionAdd()
    {
        $attribute = new Attribute();
        $attribute->setKey('Atributo 1');
        $attribute->setValue('Valor 1');


        $attributeCollection = new AttributeCollection();
        $attributeCollection->add($attribute);

        $expected = '{"Atributo 1":"Valor 1"}';

        $this->assertEquals(
            $expected,
            json_encode($attributeCollection)
        );
    }    
}

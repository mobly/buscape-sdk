<?php
namespace Mobly\Buscape\Tests\Collection\Product;

use Mobly\Buscape\Sdk\Collection\Product\SpecificationCollection;
use Mobly\Buscape\Sdk\Entity\Product\Specification;

/**
 * Unit tests for SpecificationCollection
 *
 * @package Mobly\Buscape\Tests\Collection\Product
 * @author Wilton Garcia <wilton.oliveira@mobly.com.br>, <wiltonog@gmail.com>
 **/
class SpecificationCollectionTest extends \PHPUnit_Framework_TestCase 
{
    /**
     * Test of the add method
     *
     * @return void
     **/
    public function testSpecificationCollectionAdd()
    {
        $specification = new Specification();
        $specification->setKey('Especificação 1');
        $specification->setValue('Valor');


        $specificationCollection = new SpecificationCollection();
        $specificationCollection->add($specification);

        $expected = '[{"Especifica\u00e7\u00e3o 1":"Valor"}]';

        $this->assertEquals(
            $expected,
            json_encode($specificationCollection)
        );
    }    
}

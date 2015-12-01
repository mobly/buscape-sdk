<?php
namespace Mobly\Buscape\Tests\Entity;

use Mobly\Buscape\Sdk\Entity\Product;

/**
 * Class ProductEntityTest
 * @package Mobly\Buscape\Tests\Entity
 */
class ProductEntityTest extends \PHPUnit_Framework_TestCase
{
    public function testInstanceOf()
    {
        $product = new Product();

        $expected = 'Mobly\Buscape\Sdk\Entity\Product';

        $this->assertInstanceOf(
            $expected,
            $product
        );
    }

    public function testValidateFalse()
    {
        $product = new Product();

        $this->assertFalse(
            $product->isValid()
        );
    }

    public function testValidateTrue()
    {
        $product = new Product(
            [
                'sku' => 'unit',
                'prices' => 10.00,
                'quantity' => 1,
                'category' => 'Unit > Test',
                'description' => 'Test unit to product',
                'images' => [
                    'http://image.com/teste.jpg',
                    'http://image.com/teste2.jpg'
                ],
                'link' => 'http://link.com/unit',
                'technicalSpecification' => [
                    'Use' => 'Unit',
                    'Another' => 'Unit',
                ],
                'sizeHeight' => 10,
                'sizeLength' => 10,
                'sizeWidth' => 10,
                'weightValue' => 10,
                'marketplace' => 'PHP Unit'
            ]
        );

        $this->assertTrue(
            $product->isValid()
        );

        echo json_encode($product);
    }
}

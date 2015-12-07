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
                'prices' => [
                    [
                        'type' => Product\Price::TYPE_BOLETO,
                        'price' => 100.00
                    ],
                    [
                        'type' => Product\Price::TYPE_CARTAO_PARCELADO_COM_JUROS,
                        'price' => 150.00,
                        'installments' => 3,
                        'installmentsValue' => 50,
                    ]
                ],
                'quantity' => 1,
                'category' => 'Unit > Test',
                'description' => 'Test unit to product',
                'images' => [
                    [
                        'url' => 'http://image.com/teste10.jpg'
                    ],
                    [
                        'url' => 'http://image.com/teste20.jpg'
                    ],
                ],
                'link' => 'http://link.com/unit',
                'technicalSpecification' => [
                    [
                        'key' => 'Unit2',
                        'value' => 'Use',
                    ],
                    [
                        'key' => 'Another',
                        'value' => 'Unit2',
                    ],
                ],
                'sizeHeight' => 10,
                'sizeLength' => 10,
                'sizeWidth' => 10,
                'weightValue' => 0,
                'marketplace' => 'PHP Unit'
            ]
        );

        $this->assertTrue(
            $product->isValid()
        );

    }
}

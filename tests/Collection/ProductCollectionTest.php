<?php
namespace Mobly\Buscape\Tests\Collection;

use Mobly\Buscape\Sdk\Collection\Product\PriceCollection;
use Mobly\Buscape\Sdk\Collection\ProductCollection;
use Mobly\Buscape\Sdk\Entity\Product;

/**
 * Class ProductCollectionTest
 * @package Mobly\Buscape\Tests\Collection
 */
class ProductCollectionTest extends \PHPUnit_Framework_TestCase
{
    public function testInstanceOf()
    {
        $productCollection = new ProductCollection();

        $expected = 'Mobly\Buscape\Sdk\Collection\ProductCollection';

        $this->assertInstanceOf(
            $expected,
            $productCollection
        );
    }

    public function testAddProduct()
    {
        $productCollection = new ProductCollection();

        $priceCollection = new PriceCollection();

        $priceAvista = new Product\Price(
            [
                'type' => Product\Price::TYPE_BOLETO,
                'price' => 99.99
            ]
        );

        $priceCollection->add($priceAvista);

        $priceParcelado = new Product\Price(
            [
                'type' => Product\Price::TYPE_CARTAO_PARCELADO_SEM_JUROS,
                'price' => 99.99,
                'installment' => 3,
                'installmentValue' => 33.33
            ]
        );

        $priceCollection->add($priceParcelado);

        $product1 = new Product(
            [
                'sku' => 'unit',
                'prices' => $priceCollection,
                'quantity' => 1,
                'category' => 'Unit > Test',
                'description' => 'Test unit to product',
                'images' => [
                    [
                        'url' => 'http://image.com/teste1.jpg'
                    ],
                    [
                        'url' => 'http://image.com/teste2.jpg'
                    ],
                ],
                'link' => 'http://link.com/unit',
                'technicalSpecification' => [
                    [
                        'key' => 'Unit',
                        'value' => 'Use',
                    ],
                    [
                        'key' => 'Another',
                        'value' => 'Unit',
                    ],
                ],
                'sizeHeight' => 10,
                'sizeLength' => 10,
                'sizeWidth' => 10,
                'weightValue' => 0,
                'marketplace' => 'PHP Unit'
            ]
        );

        $productCollection->add($product1);

        $product2 = new Product(
            [
                'sku' => 'unit101001',
                'prices' => [
                    [
                        'type' => Product\Price::TYPE_CARTAO_AVISTA,
                        'price' => 50.50
                    ],
                    [
                        'type' => Product\Price::TYPE_CARTAO_PARCELADO_SEM_JUROS,
                        'price' => 50.50,
                        'installment' => 2,
                        'installmentValue' => 25.25,
                    ]
                ],
                'quantity' => 2,
                'category' => 'Unit > Test',
                'description' => 'Test unit to product<br>',
                'images' => [
                    [
                        'url' => 'http://image.com/teste3.jpg'
                    ],
                    [
                        'url' => 'http://image.com/teste4.jpg'
                    ],
                ],
                'link' => 'http://link.com/unit2',
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
                'sizeHeight' => 9,
                'sizeLength' => 8,
                'sizeWidth' => 7,
                'weightValue' => 6,
                'marketplace' => 'PHP Unit',
                'barcode' => '123'
            ]
        );

        $productCollection->add($product2);

    }
}

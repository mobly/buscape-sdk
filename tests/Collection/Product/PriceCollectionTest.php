<?php

namespace Mobly\Buscape\Tests\Collection\Product;

use Mobly\Buscape\Sdk\Collection\Product\PriceCollection as Collection;
use Mobly\Buscape\Sdk\Entity\Product\Price as Entity;

/**
 * Class PriceCollectionTest
 *
 * @package Mobly\Buscape\Tests\Collection\Product
 */
class PriceCollectionTest extends \PHPUnit_Framework_TestCase
{
    protected $priceCollection;

    public function testPriceCollectionAdd()
    {
        $priceCollection = new Collection();

        $priceEntity = new Entity(
            [
                'type' => Entity::TYPE_BOLETO,
                'price' => 50.00,
                'priceLomadee' => 0.00,
                'installment' => 0,
                'installmentValue' => 0,
            ]
        );

        $priceCollection->add($priceEntity);

        $priceEntity = new Entity(
            [
                'type' => Entity::TYPE_CARTAO_AVISTA,
                'price' => 50.00,
                'priceLomadee' => 0.00,
                'installment' => 1,
                'installmentValue' => 45.00,
            ]
        );

        $priceCollection->add($priceEntity);

        $priceEntity = new Entity(
            [
                'type' => Entity::TYPE_CARTAO_PARCELADO_SEM_JUROS,
                'price' => 50.00,
                'priceLomadee' => 0.00,
                'installment' => 2,
                'installmentValue' => 25.00,
            ]
        );

        $priceCollection->add($priceEntity);

        $expected = '[{"type":"boleto","price":50,"priceLomadee":0,"installment":0,"installmentValue":0},{"type":"cartao_avista","price":50,"priceLomadee":0,"installment":1,"installmentValue":45},{"type":"cartao_parcelado_sem_juros","price":50,"priceLomadee":0,"installment":2,"installmentValue":25}]';

        $this->assertEquals(
            $expected,
            json_encode($priceCollection)
        );
    }
}

<?php
namespace Mobly\Buscape\Tests\Collection\Product;

use Mobly\Buscape\Sdk\Collection\Product\ImageCollection;
use Mobly\Buscape\Sdk\Entity\Product\Image;

/**
 * Unit tests for ImageCollection
 *
 * @package Mobly\Buscape\Tests\Collection\Product
 * @author Wilton Garcia <wilton.oliveira@mobly.com.br>, <wiltonog@gmail.com>
 **/
class ImageCollectionTest extends \PHPUnit_Framework_TestCase 
{
    /**
     * Test of the add method
     *
     * @return void
     **/
    public function testImageCollectionAdd()
    {
        $image = new Image();
        $image->setUrl('http://mobly.com.br/imagem-legal.gif');

        $imageCollection = new ImageCollection();
        $imageCollection->add($image);

        $expected = '["http:\/\/mobly.com.br\/imagem-legal.gif"]';

        $this->assertEquals(
            $expected,
            json_encode($imageCollection)
        );
    }    
}

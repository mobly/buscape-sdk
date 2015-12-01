<?php

namespace Mobly\Buscape\Sdk\Entity;

use Mobly\Buscape\Sdk\Collection\Product\AttributeCollection;
use Mobly\Buscape\Sdk\Collection\Product\ImageCollection;
use Mobly\Buscape\Sdk\Collection\Product\PriceCollection;
use Mobly\Buscape\Sdk\Validator\RequiredTrait;

/**
 * Class Product
 *
 * @package Mobly\Buscape\Entity
 */
class Product extends EntityAbstract
{
    /**
     * Product variation group ID
     * Ex. Shoe XXX White (sku 100 - groupId 1), Shoe XXX Black (sku 200 - groupId 1),
     * Shoe XXX Blue (sku 300 - groupId 1).
     *
     * @var string
     */
    protected $groupId;

    /**
     * Product ID
     * 240 characters max.
     *
     * @var string
     */
    protected $sku;

    /**
     * Product Name
     *
     * @var string
     */
    protected $title;

    /**
     * Product barcode
     * 240 characters max.
     *
     * @var string
     */
    protected $barcode;

    /**
     * Product category
     * Ex. Electronics > TV
     * 255 characters max.
     *
     * @var string
     */
    protected $category;

    /**
     * Product description or synopsis
     * HTML tags accepted:
     * <p>, <br>, <b>, <strong>, <i>
     * <div> and <span>
     *
     * Not accepted another tag or script or CSS
     *
     * @var string
     */
    protected $description;

    /**
     * Image list of product
     * 4094 characters max per image
     *
     * @var ImageCollection
     */
    protected $images;

    /**
     * ISBN code for books
     *
     * @var string
     */
    protected $isbn;

    /**
     * Product link to Buscapé
     * 4094 characters max.
     *
     * @var string
     */
    protected $link;

    /**
     * Product link to Lomadee publishers
     * 4094 characters max.
     *
     * @var string
     */
    protected $linkLomadee;

    /**
     * Price list of product.
     * Need at least two prices
     * boleto or cartao_avista and cartao_parcelado_sem_juros or cartao_parcelado_com_juros
     *
     * @var PriceCollection
     */
    protected $prices;

    /**
     * Main features of product variation
     * Ex. color, voltage, size and etc
     *
     * @var AttributeCollection
     */
    protected $productAttributes;

    /**
     * Technical specifications of the product
     * Ex. screen size, material type, brand and etc
     *
     * @var array
     */
    protected $technicalSpecification;

    /**
     * Quantity of product in stock
     *
     * @var int
     */
    protected $quantity;

    /**
     * Product height. (cm)
     *
     * @var float
     */
    protected $sizeHeight;

    /**
     * Product length. (cm)
     *
     * @var float
     */
    protected $sizeLength;

    /**
     * Product width. (cm)
     *
     * @var float
     */
    protected $sizeWidth;

    /**
     * Product weight. (grams)
     *
     * @var float
     */
    protected $weightValue;

    /**
     * Price declared to secure of the Correios.
     *
     * @var float
     */
    protected $declaredPrice;

    /**
     * Product handling time.
     *
     * @var int
     */
    protected $handlingTimeDays;

    /**
     * It indicates if this product is sold in the marketplace model, i.e., not sold by the store.
     *
     * @var boolean
     */
    protected $marketplace;

    /**
     * Name of marketplace store
     *
     * @var string
     */
    protected $marketplaceName;

    /**
     * Status of call
     *
     * @var string
     */
    protected $status;

    /**
     * Errors of call
     *
     * @var array
     */
    protected $errors;

    /**
     * Required properties
     *
     * @var array
     */
    protected $required = [
        'sku',
        'prices',
        'quantity',
        'category',
        'description',
        'images',
        'link',
        'technicalSpecification',
        'sizeHeight',
        'sizeLength',
        'sizeWidth',
        'weightValue',
        'marketplace'
    ];

    /**
     * Product constructor.
     *
     * @param array $data
     */
    public function __construct($data = [])
    {
        parent::__construct($data);
        $this->validateRequired($this);
    }

    public function isValid()
    {
        return !count($this->errors) > 0;
    }

    /**
     * @return string
     */
    public function getGroupId()
    {
        return $this->groupId;
    }

    /**
     * @param string $groupId
     */
    public function setGroupId($groupId)
    {
        $this->groupId = $groupId;
    }

    /**
     * @return string
     */
    public function getSku()
    {
        return $this->sku;
    }

    /**
     * @param string $sku
     */
    public function setSku($sku)
    {
        $this->sku = $sku;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getBarcode()
    {
        return $this->barcode;
    }

    /**
     * @param string $barcode
     */
    public function setBarcode($barcode)
    {
        $this->barcode = $barcode;
    }

    /**
     * @return string
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param string $category
     */
    public function setCategory($category)
    {
        $this->category = $category;
    }

    /**
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return array
     */
    public function getImages()
    {
        return $this->images;
    }

    /**
     * @param ImageCollection $images
     */
    public function setImages(ImageCollection $images)
    {
        $this->images = $images;
    }

    /**
     * @return string
     */
    public function getIsbn()
    {
        return $this->isbn;
    }

    /**
     * @param string $isbn
     */
    public function setIsbn($isbn)
    {
        $this->isbn = $isbn;
    }

    /**
     * @return string
     */
    public function getLink()
    {
        return $this->link;
    }

    /**
     * @param string $link
     */
    public function setLink($link)
    {
        $this->link = $link;
    }

    /**
     * @return string
     */
    public function getLinkLomadee()
    {
        return $this->linkLomadee;
    }

    /**
     * @param string $linkLomadee
     */
    public function setLinkLomadee($linkLomadee)
    {
        $this->linkLomadee = $linkLomadee;
    }

    /**
     * @return array
     */
    public function getPrices()
    {
        return $this->prices;
    }

    /**
     * @param PriceCollection $prices
     */
    public function setPrices(PriceCollection $prices)
    {
        $this->prices = $prices;
    }

    /**
     * @return array
     */
    public function getProductAttributes()
    {
        return $this->productAttributes;
    }

    /**
     * @param AttributeCollection $productAttributes
     */
    public function setProductAttributes(AttributeCollection $productAttributes)
    {
        $this->productAttributes = $productAttributes;
    }

    /**
     * @return array
     */
    public function getTechnicalSpecification()
    {
        return $this->technicalSpecification;
    }

    /**
     * @param array $technicalSpecification
     */
    public function setTechnicalSpecification($technicalSpecification)
    {
        $this->technicalSpecification = $technicalSpecification;
    }

    /**
     * @return int
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * @param int $quantity
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
    }

    /**
     * @return float
     */
    public function getSizeHeight()
    {
        return $this->sizeHeight;
    }

    /**
     * @param float $sizeHeight
     */
    public function setSizeHeight($sizeHeight)
    {
        $this->sizeHeight = $sizeHeight;
    }

    /**
     * @return float
     */
    public function getSizeLength()
    {
        return $this->sizeLength;
    }

    /**
     * @param float $sizeLength
     */
    public function setSizeLength($sizeLength)
    {
        $this->sizeLength = $sizeLength;
    }

    /**
     * @return float
     */
    public function getSizeWidth()
    {
        return $this->sizeWidth;
    }

    /**
     * @param float $sizeWidth
     */
    public function setSizeWidth($sizeWidth)
    {
        $this->sizeWidth = $sizeWidth;
    }

    /**
     * @return float
     */
    public function getWeightValue()
    {
        return $this->weightValue;
    }

    /**
     * @param float $weightValue
     */
    public function setWeightValue($weightValue)
    {
        $this->weightValue = $weightValue;
    }

    /**
     * @return float
     */
    public function getDeclaredPrice()
    {
        return $this->declaredPrice;
    }

    /**
     * @param float $declaredPrice
     */
    public function setDeclaredPrice($declaredPrice)
    {
        $this->declaredPrice = $declaredPrice;
    }

    /**
     * @return int
     */
    public function getHandlingTimeDays()
    {
        return $this->handlingTimeDays;
    }

    /**
     * @param int $handlingTimeDays
     */
    public function setHandlingTimeDays($handlingTimeDays)
    {
        $this->handlingTimeDays = $handlingTimeDays;
    }

    /**
     * @return boolean
     */
    public function isMarketplace()
    {
        return $this->marketplace;
    }

    /**
     * @param boolean $marketplace
     */
    public function setMarketplace($marketplace)
    {
        $this->marketplace = $marketplace;
    }

    /**
     * @return string
     */
    public function getMarketplaceName()
    {
        return $this->marketplaceName;
    }

    /**
     * @param string $marketplaceName
     */
    public function setMarketplaceName($marketplaceName)
    {
        $this->marketplaceName = $marketplaceName;
    }

    /**
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @param string $status
     */
    public function setStatus($status)
    {
        $this->status = $status;
    }

    /**
     * @return array
     */
    public function getErrors()
    {
        return $this->errors;
    }

    /**
     * @param array $errors
     */
    public function setErrors($errors)
    {
        $this->errors = $errors;
    }
}
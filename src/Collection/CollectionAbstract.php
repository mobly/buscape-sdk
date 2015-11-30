<?php

namespace Mobly\Buscape\Sdk\Collection;

use Mobly\Buscape\Sdk\Entity\EntityAbstract;
use Mobly\Buscape\Sdk\Entity\Product;

/**
 * Class CollectionAbstract
 *
 * @package Mobly\Buscape\Sdk\Collection
 */
abstract class CollectionAbstract implements \JsonSerializable
{
    /**
     * @var array
     */
    protected $collection = [];

    /**
     * @param EntityAbstract $abstractEntity
     * @param null $key
     */
    public function add(EntityAbstract $abstractEntity, $key = null)
    {
        if (is_null($key)) {
            $this->collection[] = $abstractEntity;
        } else {
            $this->collection[$key] = $abstractEntity;
        }
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        return $this->collection;
    }

    /**
     * @return array
     */
    public function getErrors()
    {
        $errors = [];

        /** @var Product $item */
        foreach ($this->collection as $item) {
            if ($item->hasErrors()) {
                $errors[$item->getSku()] = $item->getErrors();
            }
        }

        return $errors;
    }

}

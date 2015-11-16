<?php

namespace Mobly\Buscape\Sdk\Collection;

use Mobly\Buscape\Sdk\Entity\EntityAbstract;

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
}

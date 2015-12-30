<?php

namespace Mobly\Buscape\Sdk\Client\Request;

/**
 * Request Paginator
 *
 * @link http://php.net/manual/pt_BR/class.iterator.php
 *
 * @package Mobly\Buscape\Sdk\Client\Request
 * @author Wilton Garcia <wilton.oliveira@mobly.com.br>, <wiltonog@gmail.com>
**/
class Paginator implements \Iterator
{
    /**
     * Position
     *
     * @var string
     **/
    private $position = 0;

    /**
     * All of the items being paginated.
     *
     * @var array
     */
    protected $items;

    /**
     * The number of items to be shown per page.
     *
     * @var int
     */
    protected $perPage;

    /**
     * The current page being "viewed".
     *
     * @var array
     */
    protected $currentPage;

    /**
     * Paginator constructor.
     *
     * @param array $items
     * @param $perPage
     */
    public function __construct(array $items, $perPage) {
        $this->items = $items;
        $this->perPage = $perPage;
    }

    /**
     * Rewind
     *
     * @return void
     **/
    public function rewind() {
        $this->position = 0;
    }

    /**
     * Return the current page
     *
     * @return array
     **/
    public function current() {
        $this->currentPage = array_slice($this->items, $this->position, $this->perPage);
        return $this->currentPage;
    }

    /**
     * Return the current position
     *
     * @return integer
     **/
    public function key() {
        return $this->position;
    }

    /**
     * Moves the position to next page
     *
     * @return void
     **/
    public function next() {
        $this->position += $this->perPage;
    }

    /**
     * Validate if position exists
     *
     * @return boolean
     **/
    public function valid() {
        return isset($this->items[$this->position]);
    }
}

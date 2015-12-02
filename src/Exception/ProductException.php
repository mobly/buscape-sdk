<?php

namespace Mobly\Buscape\Exception;

/**
 * Class ProductException
 *
 * @package Mobly\Buscape\Exception
 */
class ProductException extends \Exception
{
    /**
     * ProductException constructor.
     *
     * @param string $message
     * @param int $code
     */
    public function __construct($message, $code = 0)
    {
        parent::__construct($message, $code);
    }
}
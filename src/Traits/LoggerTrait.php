<?php
namespace Mobly\Buscape\Sdk\Traits;

use Psr\Log\LoggerAwareTrait;
use Psr\Log\LoggerTrait as LoggerAbstract;

/**
 * Class LoggerTrait
 * @package Mobly\Buscape\Sdk
 */
trait LoggerTrait
{
    use LoggerAbstract;
    use LoggerAwareTrait;

    /**
     * @return \Psr\Log\LoggerInterface
     */
    public function getLogger()
    {
        return $this->logger;
    }

    /**
     * @param $logger
     */
    public function initLogger($logger)
    {
        if (!empty($logger)) {
            $this->setLogger($logger);
        }
    }

    /**
     * @param $level
     * @param $message
     * @param array $context
     *
     * @return null
     */
    public function log($level, $message, array $context = array())
    {
        if ($this->getLogger()) {
            return $this->getLogger()->log($level, $message, $context);
        }
    }
}
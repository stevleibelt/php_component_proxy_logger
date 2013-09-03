<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-08-29 
 */

namespace Net\Bazzline\Component\Logger\BufferManipulation;

use Net\Bazzline\Component\DataType\DataArray;
use Net\Bazzline\Component\Logger\Exception\InvalidArgumentException;

/**
 * Class VoidLogLevelGateKeeper
 *
 * @package Net\Bazzline\Component\Logger
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-08-29
 */
class VoidLogLevelGateKeeper implements FlushBufferTriggerInterface
{
    /**
     * @param mixed $logLevel
     * @return $this
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-09-03
     */
    public function addTrigger($logLevel)
    {
        return $this;
    }

    /**
     * @param mixed $logLevel
     * @return bool
     * @throws InvalidArgumentException
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-29
     */
    public function triggerBufferFlush($logLevel)
    {
        return true;
    }
}
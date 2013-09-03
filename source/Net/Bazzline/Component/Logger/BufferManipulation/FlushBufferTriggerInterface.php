<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-08-29 
 */

namespace Net\Bazzline\Component\Logger\BufferManipulation;

use Net\Bazzline\Component\Logger\Exception\InvalidArgumentException;

/**
 * Class LogLevelTriggerThresholdInterface
 *
 * @package Net\Bazzline\Component\Logger
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-08-29
 */
interface FlushBufferTriggerInterface
{
    /**
     * @param mixed $logLevel
     * @return $this
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-09-03
     */
    public function addTrigger($logLevel);

    /**
     * @param string $logLevel
     * @return bool
     * @throws InvalidArgumentException
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-29
     */
    public function triggerBufferFlush($logLevel);
}
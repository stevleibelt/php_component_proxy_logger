<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-08-29 
 */

namespace Net\Bazzline\Component\ProxyLogger\BufferManipulator;

use Net\Bazzline\Component\DataType\DataArray;
use Net\Bazzline\Component\ProxyLogger\Exception\InvalidArgumentException;

/**
 * Class NeverFlushBufferTrigger
 *
 * @package Net\Bazzline\Component\ProxyLogger
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-09-04
 */
class NeverFlushBufferTrigger extends AbstractFlushBufferTrigger
{
    /**
     * @param mixed $logLevel
     * @return bool
     * @throws InvalidArgumentException
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-29
     */
    public function triggerBufferFlush($logLevel)
    {
        return false;
    }
}
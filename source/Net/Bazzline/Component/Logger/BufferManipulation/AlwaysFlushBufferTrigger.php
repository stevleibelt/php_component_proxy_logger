<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-08-29 
 */

namespace Net\Bazzline\Component\Logger\BufferManipulation;

use Net\Bazzline\Component\DataType\DataArray;
use Net\Bazzline\Component\Logger\Exception\InvalidArgumentException;

/**
 * Class AlwaysFlushBufferTrigger
 *
 * @package Net\Bazzline\Component\Logger
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-08-29
 */
class AlwaysFlushBufferTrigger extends AbstractFlushBufferTrigger
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
        return true;
    }
}
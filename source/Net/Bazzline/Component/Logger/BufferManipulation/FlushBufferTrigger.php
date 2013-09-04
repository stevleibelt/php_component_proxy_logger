<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-09-04 
 */

namespace Net\Bazzline\Component\Logger\BufferManipulation;

use Net\Bazzline\Component\Logger\Exception\InvalidArgumentException;

/**
 * Class FlushBufferTrigger
 *
 * @package Net\Bazzline\Component\Logger\BufferManipulation
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-09-04
 */
class FlushBufferTrigger extends AbstractFlushBufferTrigger
{
    /**
     * @param string $logLevel
     * @return bool
     * @throws InvalidArgumentException
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-29
     */
    public function triggerBufferFlush($logLevel)
    {
        return ($this->hasTrigger()
            && ($this->trigger == $logLevel));
    }
}
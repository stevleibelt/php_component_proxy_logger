<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-08-26 
 */

namespace Net\Bazzline\Component\Logger\Factory;

use Net\Bazzline\Component\Logger\BufferManipulation\BypassBufferInterface;
use Net\Bazzline\Component\Logger\BufferManipulation\FlushBufferTriggerInterface;
use Net\Bazzline\Component\Logger\Proxy\ManipulateBufferLogger;
use Psr\Log\LoggerInterface;

/**
 * Class ManipulateBufferLoggerFactory
 *
 * @package Net\Bazzline\Component\Logger\Factory
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-08-26
 */
class ManipulateBufferLoggerFactory implements ManipulateBufferLoggerFactoryInterface
{
    /**
     * @param LoggerInterface $logger
     * @param null|FlushBufferTriggerInterface $flushBufferTrigger
     * @param null|BypassBufferInterface $avoidBuffer
     * @return ManipulateBufferLogger
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-26
     */
    public function create(LoggerInterface $logger, FlushBufferTriggerInterface $flushBufferTrigger = null, BypassBufferInterface $avoidBuffer = null)
    {
        $triggerBufferLogger = new ManipulateBufferLogger();
        $triggerBufferLogger->addLogger($logger);

        if (!is_null($flushBufferTrigger)) {
            $triggerBufferLogger->setFlushBufferTrigger($flushBufferTrigger);
        }

        if (!is_null($avoidBuffer)) {
            $triggerBufferLogger->setBypassBuffer($avoidBuffer);
        }

        return $triggerBufferLogger;
    }
}

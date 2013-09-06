<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-08-26 
 */

namespace Net\Bazzline\Component\Logger\Factory;

use Net\Bazzline\Component\Logger\BufferManipulation\AvoidBufferInterface;
use Net\Bazzline\Component\Logger\BufferManipulation\FlushBufferTriggerInterface;
use Net\Bazzline\Component\Logger\Proxy\TriggerBufferLogger;
use Psr\Log\LoggerInterface;

/**
 * Class TriggerBufferLoggerFactory
 *
 * @package Net\Bazzline\Component\Logger\Factory
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-08-26
 */
class TriggerBufferLoggerFactory implements TriggerBufferLoggerFactoryInterface
{
    /**
     * @param LoggerInterface $logger
     * @param null|FlushBufferTriggerInterface $flushBufferTrigger
     * @param null|AvoidBufferInterface $avoidBuffer
     * @return TriggerBufferLogger
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-26
     */
    public function create(LoggerInterface $logger, FlushBufferTriggerInterface $flushBufferTrigger = null, AvoidBufferInterface $avoidBuffer = null)
    {
        $triggerBufferLogger = new TriggerBufferLogger();
        $triggerBufferLogger->addLogger($logger);

        if (!is_null($flushBufferTrigger)) {
            $triggerBufferLogger->setFlushBufferTrigger($flushBufferTrigger);
        }

        if (!is_null($avoidBuffer)) {
            $triggerBufferLogger->setAvoidBuffer($avoidBuffer);
        }

        return $triggerBufferLogger;
    }
}

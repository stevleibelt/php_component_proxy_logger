<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-08-26 
 */

namespace Net\Bazzline\Component\ProxyLogger\Factory;

use Net\Bazzline\Component\ProxyLogger\BufferManipulation\BypassBufferInterface;
use Net\Bazzline\Component\ProxyLogger\BufferManipulation\FlushBufferTriggerInterface;
use Net\Bazzline\Component\ProxyLogger\Proxy\ManipulateBufferLogger;
use Psr\Log\LoggerInterface;

/**
 * Class ManipulateBufferLoggerFactory
 *
 * @package Net\Bazzline\Component\ProxyLogger\Factory
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-08-26
 */
class ManipulateBufferLoggerFactory implements ManipulateBufferLoggerFactoryInterface
{
    /**
     * @param LoggerInterface $logger
     * @param LogRequestFactoryInterface $logRequestFactory
     * @param LogRequestBufferFactoryInterface $logRequestBufferFactory
     * @param null|FlushBufferTriggerInterface $flushBufferTrigger
     * @param null|BypassBufferInterface $bypassBuffer
     * @return \Net\Bazzline\Component\ProxyLogger\Proxy\ManipulateBufferLoggerInterface
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-26
     */
    public function create(LoggerInterface $logger, LogRequestFactoryInterface $logRequestFactory, LogRequestBufferFactoryInterface $logRequestBufferFactory, FlushBufferTriggerInterface $flushBufferTrigger = null, BypassBufferInterface $bypassBuffer = null)
    {
        $manipulateBufferLogger = new ManipulateBufferLogger();
        $manipulateBufferLogger->addLogger($logger);
        $manipulateBufferLogger->setLogRequestFactory($logRequestFactory);
        $manipulateBufferLogger->setLogRequestBufferFactory($logRequestBufferFactory);

        if (!is_null($flushBufferTrigger)) {
            $manipulateBufferLogger->setFlushBufferTrigger($flushBufferTrigger);
        }

        if (!is_null($bypassBuffer)) {
            $manipulateBufferLogger->setBypassBuffer($bypassBuffer);
        }

        return $manipulateBufferLogger;
    }
}

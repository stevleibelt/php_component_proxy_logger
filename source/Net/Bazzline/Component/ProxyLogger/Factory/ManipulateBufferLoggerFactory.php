<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-08-26 
 */

namespace Net\Bazzline\Component\ProxyLogger\Factory;

use Net\Bazzline\Component\ProxyLogger\BufferManipulator\BypassBufferInterface;
use Net\Bazzline\Component\ProxyLogger\BufferManipulator\FlushBufferTriggerInterface;
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
     * If not provided, following factories are used as default.
     *  - LogRequestFactory with log request class name of LogRequest
     *  - LogRequestRuntimeBufferFactory
     *
     * @param LoggerInterface $logger
     * @param null|LogRequestFactoryInterface $logRequestFactory
     * @param null|LogRequestBufferFactoryInterface $logRequestBufferFactory
     * @param null|FlushBufferTriggerInterface $flushBufferTrigger
     * @param null|BypassBufferInterface $bypassBuffer
     * @return \Net\Bazzline\Component\ProxyLogger\Proxy\ManipulateBufferLoggerInterface
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-26
     */
    public function create(LoggerInterface $logger, LogRequestFactoryInterface $logRequestFactory = null, LogRequestBufferFactoryInterface $logRequestBufferFactory = null, FlushBufferTriggerInterface $flushBufferTrigger = null, BypassBufferInterface $bypassBuffer = null)
    {
        $manipulateBufferLogger = new ManipulateBufferLogger();

        if (is_null($logRequestFactory)) {
            $logRequestFactory = new LogRequestFactory();
            $logRequestFactory->setLogRequestClassName('LogRequest');
        }

        if (is_null($logRequestBufferFactory)) {
            $logRequestBufferFactory = new LogRequestRuntimeBufferFactory();
        }

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

<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-09-08 
 */

namespace Net\Bazzline\Component\ProxyLogger\Factory;

use Net\Bazzline\Component\ProxyLogger\Proxy\BufferLogger;
use Psr\Log\LoggerInterface;

/**
 * Class BufferLoggerFactory
 *
 * @package Net\Bazzline\Component\ProxyLogger\Factory
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-09-08
 */
class BufferLoggerFactory implements BufferLoggerFactoryInterface
{
    /**
     * If not provided, following factories are used as default.
     *  - LogRequestFactory with log request class name of LogRequest
     *  - LogRequestRuntimeBufferFactory
     *
     * @param LoggerInterface $logger
     * @param null|LogRequestFactoryInterface $logRequestFactory
     * @param null|LogRequestBufferFactoryInterface $logRequestBufferFactory
     * @return \Net\Bazzline\Component\ProxyLogger\Proxy\BufferLoggerInterface
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-09-08
     */
    public function create(LoggerInterface $logger, LogRequestFactoryInterface $logRequestFactory = null, LogRequestBufferFactoryInterface $logRequestBufferFactory = null)
    {
        $bufferLogger = new BufferLogger();

        if (is_null($logRequestFactory)) {
            $logRequestFactory = new LogRequestFactory();
            $logRequestFactory->setLogRequestClassName('LogRequest');
        }

        if (is_null($logRequestBufferFactory)) {
            $logRequestBufferFactory = new LogRequestRuntimeBufferFactory();
        }

        $bufferLogger->addLogger($logger);
        $bufferLogger->setLogRequestFactory($logRequestFactory);
        $bufferLogger->setLogRequestBufferFactory($logRequestBufferFactory);

        return $bufferLogger;
    }
}
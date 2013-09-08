<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-09-08 
 */

namespace Net\Bazzline\Component\ProxyLogger\Factory;

use Psr\Log\LoggerInterface;

/**
 * Class BufferLoggerFactoryInterface
 *
 * @package Net\Bazzline\Component\ProxyLogger\Factory
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-09-08
 */
interface BufferLoggerFactoryInterface
{
    /**
     * @param LoggerInterface $logger
     * @param LogRequestFactoryInterface $logRequestFactory
     * @param LogRequestBufferFactoryInterface $logRequestBufferFactory
     * @return \Net\Bazzline\Component\ProxyLogger\Proxy\BufferLoggerInterface
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-09-08
     */
    public function create(LoggerInterface $logger, LogRequestFactoryInterface $logRequestFactory, LogRequestBufferFactoryInterface $logRequestBufferFactory);
}
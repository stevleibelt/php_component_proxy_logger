<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-08-26 
 */

namespace Net\Bazzline\Component\ProxyLogger\Factory;

use Net\Bazzline\Component\ProxyLogger\BufferManipulation\BypassBufferInterface;
use Net\Bazzline\Component\ProxyLogger\BufferManipulation\FlushBufferTriggerInterface;
use Psr\Log\LoggerInterface;

/**
 * Class ManipulateBufferLoggerFactoryInterface
 *
 * @package Net\Bazzline\Component\ProxyLogger\Factory
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-08-26
 */
interface ManipulateBufferLoggerFactoryInterface
{
    /**
     * @param LoggerInterface $logger
     * @param null|LogRequestFactoryInterface $logRequestFactory
     * @param null|LogRequestBufferFactoryInterface $logRequestBufferFactory
     * @param null|FlushBufferTriggerInterface $flushBufferTrigger
     * @param null|BypassBufferInterface $bypassBuffer
     * @return \Net\Bazzline\Component\ProxyLogger\Proxy\ManipulateBufferLoggerInterface
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-26
     */
    public function create(
        LoggerInterface $logger,
        LogRequestFactoryInterface $logRequestFactory = null,
        LogRequestBufferFactoryInterface $logRequestBufferFactory = null,
        FlushBufferTriggerInterface $flushBufferTrigger = null,
        BypassBufferInterface $bypassBuffer = null
    );
}
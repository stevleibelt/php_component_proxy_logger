<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-08-26 
 */

namespace Net\Bazzline\Component\Logger\Factory;

use Net\Bazzline\Component\Logger\BufferManipulation\BypassBufferInterface;
use Net\Bazzline\Component\Logger\BufferManipulation\FlushBufferTriggerInterface;
use Psr\Log\LoggerInterface;

/**
 * Class ManipulateBufferLoggerFactoryInterface
 *
 * @package Net\Bazzline\Component\Logger\Factory
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-08-26
 */
interface ManipulateBufferLoggerFactoryInterface
{
    /**
     * @param LoggerInterface $logger
     * @param null|FlushBufferTriggerInterface $flushBufferTrigger
     * @param null|BypassBufferInterface $bypassBuffer
     * @return \Net\Bazzline\Component\Logger\Proxy\ManipulateBufferLogger
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-26
     */
    public function create(LoggerInterface $logger, FlushBufferTriggerInterface $flushBufferTrigger = null, BypassBufferInterface $bypassBuffer = null);
}
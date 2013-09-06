<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-08-26 
 */

namespace Net\Bazzline\Component\Logger\Factory;

use Net\Bazzline\Component\Logger\BufferManipulation\AvoidBufferInterface;
use Net\Bazzline\Component\Logger\BufferManipulation\FlushBufferTriggerInterface;
use Psr\Log\LoggerInterface;

/**
 * Class TriggerBufferLoggerFactoryInterface
 *
 * @package Net\Bazzline\Component\Logger\Factory
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-08-26
 */
interface TriggerBufferLoggerFactoryInterface
{
    /**
     * @param LoggerInterface $logger
     * @param null|FlushBufferTriggerInterface $flushBufferTrigger
     * @param null|AvoidBufferInterface $avoidBuffer
     * @return \Net\Bazzline\Component\Logger\Proxy\TriggerBufferLogger
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-26
     */
    public function create(LoggerInterface $logger, FlushBufferTriggerInterface $flushBufferTrigger = null, AvoidBufferInterface $avoidBuffer = null);
}
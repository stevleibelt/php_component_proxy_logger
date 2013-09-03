<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-08-26 
 */

namespace Net\Bazzline\Component\Logger\Factory;

use Net\Bazzline\Component\Logger\BufferManipulation\FlushBufferTriggerInterface;
use Psr\Log\LoggerInterface;
use Net\Bazzline\Component\Logger\Exception\InvalidArgumentException;

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
     * @param mixed $LogLevelTrigger
     * @param FlushBufferTriggerInterface $logLevelThreshold
     * @return \Net\Bazzline\Component\Logger\Proxy\TriggerBufferLogger
     * @throws InvalidArgumentException
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-26
     */
    public function create(LoggerInterface $logger, $LogLevelTrigger, FlushBufferTriggerInterface $logLevelThreshold = null);
}
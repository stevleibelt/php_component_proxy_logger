<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-08-26 
 */

namespace Net\Bazzline\Component\Logger\Proxy;

use Net\Bazzline\Component\Logger\Configuration\LogLevelThresholdInterface;
use Psr\Log\LoggerInterface;
use Net\Bazzline\Component\Logger\Exception\InvalidArgumentException;

/**
 * Class TriggerBufferLoggerFactoryInterface
 *
 * @package Net\Bazzline\Component\Logger
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-08-26
 */
interface TriggerBufferLoggerFactoryInterface
{
    /**
     * @param LoggerInterface $logger
     * @param mixed $LogLevelTrigger
     * @param LogLevelThresholdInterface $logLevelThreshold
     * @return TriggerBufferLogger
     * @throws InvalidArgumentException
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-26
     */
    public function create(LoggerInterface $logger, $LogLevelTrigger, LogLevelThresholdInterface $logLevelThreshold = null);
}
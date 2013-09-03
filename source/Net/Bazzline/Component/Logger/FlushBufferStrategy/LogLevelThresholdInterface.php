<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-08-29 
 */

namespace Net\Bazzline\Component\Logger\FlushBufferStrategy;

use Net\Bazzline\Component\Logger\Exception\InvalidArgumentException;

/**
 * Class LogLevelTriggerThresholdInterface
 *
 * @package Net\Bazzline\Component\Logger
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-08-29
 */
interface LogLevelThresholdInterface
{
    /**
     * @param array $logLevelsToThreshold
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-29
     */
    public function __construct(array $logLevelsToThreshold = array());

    /**
     * @param string $currentLogLevel
     * @param string $logLevelThreshold
     * @return bool
     * @throws InvalidArgumentException
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-29
     */
    public function isThresholdReached($currentLogLevel, $logLevelThreshold);
}
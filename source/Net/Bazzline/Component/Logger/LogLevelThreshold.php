<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-08-29 
 */

namespace Net\Bazzline\Component\Logger;

use Net\Bazzline\Component\Logger\Exception\InvalidArgumentException;

/**
 * Class LogLevelThreshold
 *
 * @package Net\Bazzline\Component\Logger
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-08-29
 */
class LogLevelThreshold implements LogLevelTriggerThresholdInterface
{
    /**
     * @var array
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-29
     */
    protected $map;

    /**
     * @var
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-29
     */
    protected $transformedMap;

    /**
     * @param array $logLevelToThresholdMap
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-29
     * @todo add validation for map?
     */
    public function __construct(array $logLevelToThresholdMap)
    {
        $this->map = $logLevelToThresholdMap;
        $this->transformedMap = array();

        foreach ($this->map as $logLevelTrigger => $logLevelThresholds) {
            $this->transformedMap[$logLevelTrigger] = array_flip($logLevelThresholds);
        }
    }

    /**
     * @param mixed $logLevel
     * @param mixed $logLevelTrigger
     * @return bool
     * @throws InvalidArgumentException
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-29
     */
    public function isThresholdReached($logLevel, $logLevelTrigger)
    {
        return (isset($this->transformedMap[$logLevelTrigger])
                && isset($this->transformedMap[$logLevelTrigger][$logLevel]));
    }
}
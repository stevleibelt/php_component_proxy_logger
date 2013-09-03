<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-08-29 
 */

namespace Net\Bazzline\Component\Logger\Configuration;

use Net\Bazzline\Component\DataType\DataArray;
use Net\Bazzline\Component\Logger\Exception\InvalidArgumentException;

/**
 * Class EmptyLogLevelGateKeeper
 *
 * @package Net\Bazzline\Component\Logger
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-08-29
 */
class EmptyLogLevelGateKeeper implements LogLevelThresholdInterface
{
    /**
     * @var array
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-29
     */
    protected $transformedValue;

    /**
     * @param $logLevelsToThreshold
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-29
     * @todo add validation for map?
     */
    public function __construct(array $logLevelsToThreshold = array())
    {
        $this->transformedValue = array();

        //validate (via unittest) how often "toArray" is called
        foreach ($logLevelsToThreshold as $logLevelTrigger => $logLevelThresholds) {
            $this->transformedValue[$logLevelTrigger] = array_flip($logLevelThresholds);
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
        return (isset($this->transformedValue[$logLevelTrigger])
                && isset($this->transformedValue[$logLevelTrigger][$logLevel]));
    }
}
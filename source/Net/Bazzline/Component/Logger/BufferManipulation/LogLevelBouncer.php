<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-09-02 
 */

namespace Net\Bazzline\Component\Logger\BufferManipulation;

use Net\Bazzline\Component\DataType\DataArray;

/**
 * Class LogLevelBouncer
 *
 * @package Net\Bazzline\Component\Logger
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-09-02
 */
class LogLevelBouncer implements AvoidBufferInterface
{
    /**
     * @var array
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-29
     */
    protected $logLevelsAsKeys;

    /**
     * @param array $avoidableLogLevels
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-09-01
     */
    public function __construct(array $avoidableLogLevels = array())
    {
        $this->logLevelsAsKeys = array();

        //validate (via unittest) how often "toArray" is called
        foreach ($avoidableLogLevels as $avoidableLogLevel) {
            $this->addAvoidableLogLevel($avoidableLogLevel);
        }
    }

    /**
     * @param $logLevel
     * @return $this
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-09-03
     */
    public function addAvoidableLogLevel($logLevel)
    {
        $this->logLevelsAsKeys[$logLevel] = true;

        return $this;
    }

    /**
     * @param mixed $logLevel
     * @return bool
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-09-01
     */
    public function avoidBuffering($logLevel)
    {
        return (isset($this->logLevelsAsKeys[$logLevel]));
    }
}
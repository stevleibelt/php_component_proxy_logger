<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-09-05 
 */

namespace Net\Bazzline\Component\Logger\BufferManipulation;

/**
 * Class AbstractAvoidBuffer
 *
 * @package Net\Bazzline\Component\Logger\BufferManipulation
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-09-05
 */
abstract class AbstractAvoidBuffer implements AvoidBufferInterface
{
    /**
     * @var array
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-29
     */
    protected $logLevelsAsKeys;

    /**
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-09-05
     */
    public function __construct()
    {
        $this->logLevelsAsKeys = array();
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
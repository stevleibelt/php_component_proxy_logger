<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-09-05 
 */

namespace Net\Bazzline\Component\Logger\BufferManipulation;

use Psr\Log\LogLevel;

/**
 * Class BypassBuffer
 *
 * @package Net\Bazzline\Component\Logger\BufferManipulation
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-09-05
 */
class BypassBuffer implements BypassBufferInterface
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
     * @return $this
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-09-07
     */
    public function addBypassForLogLevelEmergency()
    {
        return $this->addBypassForLogLevel(LogLevel::EMERGENCY);
    }

    /**
     * @return $this
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-09-07
     */
    public function addBypassForLogLevelAlert()
    {
        return $this->addBypassForLogLevel(LogLevel::ALERT);
    }

    /**
     * @return $this
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-09-07
     */
    public function addBypassForLogLevelCritical()
    {
        return $this->addBypassForLogLevel(LogLevel::CRITICAL);
    }

    /**
     * @return $this
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-09-07
     */
    public function addBypassForLogLevelError()
    {
        return $this->addBypassForLogLevel(LogLevel::ERROR);
    }

    /**
     * @return $this
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-09-07
     */
    public function addBypassForLogLevelWarning()
    {
        return $this->addBypassForLogLevel(LogLevel::WARNING);
    }

    /**
     * @return $this
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-09-07
     */
    public function addBypassForLevelNotice()
    {
        return $this->addBypassForLogLevel(LogLevel::NOTICE);
    }

    /**
     * @return $this
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-09-07
     */
    public function addBypassForLogLevelInfo()
    {
        return $this->addBypassForLogLevel(LogLevel::INFO);
    }

    /**
     * @return $this
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-09-07
     */
    public function addBypassForLogLevelDebug()
    {
        return $this->addBypassForLogLevel(LogLevel::DEBUG);
    }

    /**
     * @param $logLevel
     * @return $this
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-09-03
     */
    public function addBypassForLogLevel($logLevel)
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
    public function bypassBuffer($logLevel)
    {
        return (isset($this->logLevelsAsKeys[$logLevel]));
    }
}
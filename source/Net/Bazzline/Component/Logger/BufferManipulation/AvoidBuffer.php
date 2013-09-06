<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-09-05 
 */

namespace Net\Bazzline\Component\Logger\BufferManipulation;

use Psr\Log\LogLevel;

/**
 * Class AvoidBuffer
 *
 * @package Net\Bazzline\Component\Logger\BufferManipulation
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-09-05
 */
class AvoidBuffer implements AvoidBufferInterface
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
    public function addAvoidableEmergencyLogLevel()
    {
        return $this->addAvoidableLogLevel(LogLevel::EMERGENCY);
    }

    /**
     * @return $this
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-09-07
     */
    public function addAvoidableAlertLogLevel()
    {
        return $this->addAvoidableLogLevel(LogLevel::ALERT);
    }

    /**
     * @return $this
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-09-07
     */
    public function addAvoidableCriticalLogLevel()
    {
        return $this->addAvoidableLogLevel(LogLevel::CRITICAL);
    }

    /**
     * @return $this
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-09-07
     */
    public function addAvoidableErrorLogLevel()
    {
        return $this->addAvoidableLogLevel(LogLevel::ERROR);
    }

    /**
     * @return $this
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-09-07
     */
    public function addAvoidableWarningLogLevel()
    {
        return $this->addAvoidableLogLevel(LogLevel::WARNING);
    }

    /**
     * @return $this
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-09-07
     */
    public function addAvoidableNoticeLogLevel()
    {
        return $this->addAvoidableLogLevel(LogLevel::NOTICE);
    }

    /**
     * @return $this
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-09-07
     */
    public function addAvoidableInfoLogLevel()
    {
        return $this->addAvoidableLogLevel(LogLevel::INFO);
    }

    /**
     * @return $this
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-09-07
     */
    public function addAvoidableDebugLogLevel()
    {
        return $this->addAvoidableLogLevel(LogLevel::DEBUG);
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
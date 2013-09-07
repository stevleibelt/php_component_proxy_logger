<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 9/2/13
 */

namespace Net\Bazzline\Component\ProxyLogger\BufferManipulation;

use Net\Bazzline\Component\ProxyLogger\Exception\InvalidArgumentException;
use Psr\Log\LogLevel;

/**
 * Class UpwardFlushBufferTrigger
 *
 * @package Net\Bazzline\Component\ProxyLogger\BufferManipulation
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-09-02
 */
class UpwardFlushBufferTrigger extends AbstractFlushBufferTrigger
{
    /**
     * @var array
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-09-04
     */
    protected $triggerAndUpwardLogLevelMap;

    /**
     * @var array
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-09-05
     */
    protected $upwardLogLevels;

    /**
     * @param array $logLevelsToPass
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-09-02
     */
    public function __construct(array $logLevelsToPass = array())
    {
        $this->triggerAndUpwardLogLevelMap = array(
            LogLevel::DEBUG => array(
                LogLevel::INFO => true,
                LogLevel::NOTICE => true,
                LogLevel::WARNING => true,
                LogLevel::ERROR => true,
                LogLevel::CRITICAL => true,
                LogLevel::ALERT => true,
                LogLevel::EMERGENCY => true
            ),
            LogLevel::INFO => array(
                LogLevel::NOTICE => true,
                LogLevel::WARNING => true,
                LogLevel::ERROR => true,
                LogLevel::CRITICAL => true,
                LogLevel::ALERT => true,
                LogLevel::EMERGENCY => true
            ),
            LogLevel::NOTICE => array(
                LogLevel::WARNING => true,
                LogLevel::ERROR => true,
                LogLevel::CRITICAL => true,
                LogLevel::ALERT => true,
                LogLevel::EMERGENCY => true
            ),
            LogLevel::WARNING => array(
                LogLevel::ERROR => true,
                LogLevel::CRITICAL => true,
                LogLevel::ALERT => true,
                LogLevel::EMERGENCY => true
            ),
            LogLevel::ERROR => array(
                LogLevel::CRITICAL => true,
                LogLevel::ALERT => true,
                LogLevel::EMERGENCY => true
            ),
            LogLevel::CRITICAL => array(
                LogLevel::ALERT => true,
                LogLevel::EMERGENCY => true
            ),
            LogLevel::ALERT => array(
                LogLevel::EMERGENCY => true
            )
        );
    }

    /**
     * @param mixed $logLevel
     * @return $this
     * @throws \Psr\Log\InvalidArgumentException
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-26
     */
    public function setTriggerTo($logLevel)
    {
        parent::setTriggerTo($logLevel);

        $this->upwardLogLevels = (isset($this->triggerAndUpwardLogLevelMap[$this->trigger]))
            ? $this->triggerAndUpwardLogLevelMap[$this->trigger]
            : array();

        return $this;
    }

    /**
     * @param string $logLevel
     * @return bool
     * @throws InvalidArgumentException
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-29
     */
    public function triggerBufferFlush($logLevel)
    {
        return ($this->hasTrigger()
            && (($this->trigger == $logLevel)
                || isset($this->upwardLogLevels[$logLevel])));
    }
}
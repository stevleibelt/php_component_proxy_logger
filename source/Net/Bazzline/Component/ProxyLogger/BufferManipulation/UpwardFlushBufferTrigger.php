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
    protected $upwardLogLevel;

    /**
     * @param array $logLevelsToPass
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-09-02
     */
    public function __construct(array $logLevelsToPass = array())
    {
        $this->triggerAndUpwardLogLevelMap = array(
            LogLevel::DEBUG => 0,
            LogLevel::INFO => 1,
            LogLevel::NOTICE => 2,
            LogLevel::WARNING => 3,
            LogLevel::ERROR => 4,
            LogLevel::CRITICAL => 5,
            LogLevel::ALERT => 6,
            LogLevel::EMERGENCY => 7
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

        $this->upwardLogLevel = (isset($this->triggerAndUpwardLogLevelMap[$this->trigger]))
            ? $this->triggerAndUpwardLogLevelMap[$this->trigger]
            : $this->triggerAndUpwardLogLevelMap[LogLevel::DEBUG];

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
                || ($this->upwardLogLevel >= $logLevel)));
    }
}
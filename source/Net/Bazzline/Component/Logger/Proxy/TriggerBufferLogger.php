<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-08-26
 */

namespace Net\Bazzline\Component\Logger\Proxy;

use Net\Bazzline\Component\Logger\BufferManipulation\LogLevelBouncer;
use Net\Bazzline\Component\Logger\BufferManipulation\AvoidBufferInterface;
use Net\Bazzline\Component\Logger\BufferManipulation\EmptyLogLevelGateKeeper;
use Net\Bazzline\Component\Logger\BufferManipulation\LogLevelThresholdInterface;
use Psr\Log\LogLevel;
use Net\Bazzline\Component\Logger\LogEntry\LogEntryFactoryInterface;

/**
 * Class TriggerLogger
 *
 * @package Net\Bazzline\Component\Logger
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-08-26
 */
class TriggerBufferLogger extends BufferLogger implements TriggerBufferLoggerInterface
{
    /**
     * @var mixed
     * @author sleibelt
     * @since 2013-08-26
     */
    protected $triggerLevel;

    /**
     * @var LogLevelThresholdInterface
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-09-02
     */
    protected $logLevelThreshold;

    /**
     * @var AvoidBufferInterface
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-09-02
     */
    protected $avoidBufferManipulator;

    /**
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-09-02
     */
    public function __construct()
    {
        $this->logLevelThreshold = new EmptyLogLevelGateKeeper(array());
    }

    /**
     * Logs with an arbitrary level.
     *
     * @param mixed $level
     * @param string $message
     * @param array $context
     * @return null
     */
    public function log($level, $message, array $context = array())
    {
        $this->logEntryBuffer->attach(
            $this->logEntryFactory->create($level, $message, $context)
        );

        if ($this->isTriggerLogLevel($level)) {
            $this->flush();
        }
    }

    /**
     * @return $this
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-26
     */
    public function setLogLevelTriggerToEmergency()
    {
        $this->setLogLevelTrigger(LogLevel::EMERGENCY);

        return $this;
    }

    /**
     * @return $this
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-26
     */
    public function setLogLevelTriggerToAlert()
    {
        $this->setLogLevelTrigger(LogLevel::ALERT);

        return $this;
    }

    /**
     * @return $this
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-26
     */
    public function setLogLevelTriggerToCritical()
    {
        $this->setLogLevelTrigger(LogLevel::CRITICAL);

        return $this;
    }

    /**
     * @return $this
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-26
     */
    public function setLogLevelTriggerToError()
    {
        $this->setLogLevelTrigger(LogLevel::ERROR);

        return $this;
    }

    /**
     * @return $this
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-26
     */
    public function setLogLevelTriggerToWarning()
    {
        $this->setLogLevelTrigger(LogLevel::WARNING);

        return $this;
    }

    /**
     * @return $this
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-26
     */
    public function setLogLevelTriggerToNotice()
    {
        $this->setLogLevelTrigger(LogLevel::NOTICE);

        return $this;
    }

    /**
     * @return $this
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-26
     */
    public function setLogLevelTriggerToInfo()
    {
        $this->setLogLevelTrigger(LogLevel::INFO);

        return $this;
    }

    /**
     * @return $this
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-26
     */
    public function setLogLevelTriggerToDebug()
    {
        $this->setLogLevelTrigger(LogLevel::DEBUG);

        return $this;
    }

    /**
     * @param LogEntryFactoryInterface $factory
     * @return $this
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-26
     */
    public function injectLogEntryFactory(LogEntryFactoryInterface $factory)
    {
        $this->logEntryFactory = $factory;

        return $this;
    }

    /**
     * @param mixed $level
     * @return $this
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-26
     */
    public function setLogLevelTrigger($level)
    {
        $this->triggerLevel = $level;

        return $this;
    }

    /**
     * @param LogLevelThresholdInterface $threshold
     * @return $this
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-26
     */
    public function setLogLevelThreshold(LogLevelThresholdInterface $threshold)
    {
        $this->logLevelThreshold = $threshold;

        return $this;
    }

    /**
     * @return null|mixed
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-28
     */
    public function getLogLevelTrigger()
    {
        return $this->triggerLevel;
    }

    /**
     * @return null|AvoidBufferInterface
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-09-03
     */
    public function getAvoidBufferManipulation()
    {
        return $this->avoidBufferManipulator;
    }

    /**
     * @return bool
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-09-03
     */
    public function hasAvoidBufferManipulation()
    {
        return (!is_null($this->avoidBufferManipulator));
    }

    /**
     * @param AvoidBufferInterface $avoidBuffer
     * @return $this
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-09-03
     */
    public function setAvoidBufferManipulation(AvoidBufferInterface $avoidBuffer)
    {
        $this->avoidBufferManipulator = $avoidBuffer;

        return $this;
    }

    /**
     * @param $level
     * @return bool
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-09-03
     */
    protected function letLogLevelPass($level)
    {
        return ($this->hasAvoidBufferManipulation()
            && $this->avoidBufferManipulator->avoidBuffering($level));
    }

    /**
     * @param mixed $level
     * @return bool
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-26
     */
    protected function isTriggerLogLevel($level)
    {
        return (($level == $this->triggerLevel)
                || ($this->logLevelThreshold->isThresholdReached($level, $this->triggerLevel)));
    }
}
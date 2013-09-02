<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-08-26
 */

namespace Net\Bazzline\Component\Logger\Proxy;

use Net\Bazzline\Component\Logger\Configuration\LogLevelPassThrough;
use Net\Bazzline\Component\Logger\Configuration\LogLevelPassThroughInterface;
use Net\Bazzline\Component\Logger\Configuration\LogLevelThreshold;
use Net\Bazzline\Component\Logger\Configuration\LogLevelThresholdInterface;
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
     * @var LogLevelPassThroughInterface
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-09-02
     */
    protected $logLevelPassThrough;

    /**
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-09-02
     */
    public function __construct()
    {
        $this->logLevelThreshold = new LogLevelThreshold(array());
        $this->logLevelPassThrough = new LogLevelPassThrough(array());
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
     * @param LogLevelPassThroughInterface $passThrough
     * @return $this
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-09-02
     */
    public function setLogLevelPassThrough(LogLevelPassThroughInterface $passThrough)
    {
        $this->logLevelPassThrough = $passThrough;

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
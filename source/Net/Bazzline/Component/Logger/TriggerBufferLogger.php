<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-08-26
 */

namespace Net\Bazzline\Component\Logger;

use Psr\Log\LogLevel;

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
     * @var array
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-26
     */
    protected $triggerLevels;

    /**
     * @var @var array
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-26
     */
    protected $logLevelTriggerInheritanceMap;

    /**
     * @author sleibelt
     * @since 2013-08-26
     */
    public function __construct()
    {
        $this->logLevelTriggerInheritanceMap = array();
        $this->buildTriggerLevels();
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
        $this->buildTriggerLevels();

        return $this;
    }

    /**
     * @param array $map
     * @return $this
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-26
     */
    public function setLogLevelTriggerInheritanceMap(array $map)
    {
        $this->logLevelTriggerInheritanceMap = $map;
        $this->buildTriggerLevels();

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
     * @return $this
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-26
     */
    protected function buildTriggerLevels()
    {
        if (is_null($this->triggerLevel)) {
            $this->triggerLevels = array();
        } else {
            $this->triggerLevels = (isset($this->logLevelTriggerInheritanceMap[$this->triggerLevel]))
                ? $this->logLevelTriggerInheritanceMap[$this->triggerLevel] : array($this->triggerLevel);
            //we want to gain fast access
            $this->triggerLevels = array_flip($this->triggerLevels);
        }

        return $this;
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
                || (isset($this->triggerLevels[$level])));
    }
}
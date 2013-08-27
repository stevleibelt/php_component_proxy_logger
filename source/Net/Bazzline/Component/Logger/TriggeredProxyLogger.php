<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-08-26
 */

namespace Net\Bazzline\Component\Logger;

use Psr\Log\LogLevel;

/**
 * Class ProxyLogger
 *
 * @package Net\Bazzline\Component\Logger
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-08-26
 */
class TriggeredProxyLogger extends ProxyLogger implements TriggeredProxyLoggerInterface
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
    protected $triggeredLogLevelInheritanceMap;

    /**
     * @author sleibelt
     * @since 2013-08-26
     */
    public function __construct()
    {
        parent::__construct();
        $this->triggeredLogLevelInheritanceMap = array();
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
        if ($this->isTriggeredLogLevel($level)) {
            foreach ($this->logEntryBuffer as $logEntry) {
                /**
                 * @var LogEntry $logEntry
                 */
                $this->logger->log(
                    $logEntry->getLevel(),
                    $logEntry->getMessage(),
                    $logEntry->getContext()
                );
            }
        } else {
            $this->logEntryBuffer->attach(
                $this->logEntryFactory->create($level, $message, $context)
            );
        }
    }

    /**
     * @return $this
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-26
     */
    public function setTriggerLevelToEmergency()
    {
        $this->setTriggerLevel(LogLevel::EMERGENCY);

        return $this;
    }

    /**
     * @return $this
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-26
     */
    public function setTriggerLevelToAlert()
    {
        $this->setTriggerLevel(LogLevel::ALERT);

        return $this;
    }

    /**
     * @return $this
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-26
     */
    public function setTriggerLevelToCritical()
    {
        $this->setTriggerLevel(LogLevel::CRITICAL);

        return $this;
    }

    /**
     * @return $this
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-26
     */
    public function setTriggerLevelToError()
    {
        $this->setTriggerLevel(LogLevel::ERROR);

        return $this;
    }

    /**
     * @return $this
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-26
     */
    public function setTriggerLevelToWarning()
    {
        $this->setTriggerLevel(LogLevel::WARNING);

        return $this;
    }

    /**
     * @return $this
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-26
     */
    public function setTriggerLevelToNotice()
    {
        $this->setTriggerLevel(LogLevel::NOTICE);

        return $this;
    }

    /**
     * @return $this
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-26
     */
    public function setTriggerLevelToInfo()
    {
        $this->setTriggerLevel(LogLevel::INFO);

        return $this;
    }

    /**
     * @return $this
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-26
     */
    public function setTriggerLevelToDebug()
    {
        $this->setTriggerLevel(LogLevel::DEBUG);

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
    public function setTriggerLevel($level)
    {
        $this->triggerLevel = array($level);
        $this->buildTriggerLevels();

        return $this;
    }

    /**
     * @param array $map
     * @return $this
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-26
     */
    public function setTriggeredLogLevelInheritanceMap(array $map)
    {
        $this->triggeredLogLevelInheritanceMap = $map;
        $this->buildTriggerLevels();

        return $this;
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
            $this->triggerLevels = (isset($this->triggeredLogLevelInheritanceMap[$this->triggerLevel]))
                ? $this->triggeredLogLevelInheritanceMap[$this->triggerLevel] : array($this->triggerLevel);
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
    protected function isTriggeredLogLevel($level)
    {
        return (($level == $this->triggerLevel)
                || (isset($this->triggerLevels[$level])));
    }
}
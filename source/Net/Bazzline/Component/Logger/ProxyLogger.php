<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-08-26
 */

namespace Net\Bazzline\Component\Logger;

use Psr\Log\LoggerInterface;
use Psr\Log\LogLevel;

/**
 * Class ProxyLogger
 *
 * @package Net\Bazzline\Component\Logger
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-08-26
 */
class ProxyLogger implements ProxyLoggerInterface
{
    /**
     * @var LogEntryCollection
     * @author sleibelt
     * @since 2013-08-26
     */
    protected $logEntryCacheCollection;

    /**
     * @var \Psr\Log\LoggerInterface
     * @author sleibelt
     * @since 2013-08-26
     */
    protected $logger;
    /**
     * @var LogEntryFactoryInterface
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-26
     */
    protected $logEntryFactory;

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
        $this->logEntryCacheCollection = new LogEntryCollection();
        $this->triggeredLogLevelInheritanceMap = array();
        $this->buildTriggerLevels();
    }

    /**
     * Sets a logger instance on the object
     *
     * @param LoggerInterface $logger
     * @return null
     */
    public function setLogger(\Psr\Log\LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    /**
     * System is unusable.
     *
     * @param string $message
     * @param array $context
     * @return null
     */
    public function emergency($message, array $context = array())
    {
        $this->log(LogLevel::EMERGENCY, $message, $context);
    }

    /**
     * Action must be taken immediately.
     * Example: Entire website down, database unavailable, etc. This should
     * trigger the SMS alerts and wake you up.
     *
     * @param string $message
     * @param array $context
     * @return null
     */
    public function alert($message, array $context = array())
    {
        $this->log(LogLevel::ALERT, $message, $context);
    }

    /**
     * Critical conditions.
     * Example: Application component unavailable, unexpected exception.
     *
     * @param string $message
     * @param array $context
     * @return null
     */
    public function critical($message, array $context = array())
    {
        $this->log(LogLevel::CRITICAL, $message, $context);
    }

    /**
     * Runtime errors that do not require immediate action but should typically
     * be logged and monitored.
     *
     * @param string $message
     * @param array $context
     * @return null
     */
    public function error($message, array $context = array())
    {
        $this->log(LogLevel::ERROR, $message, $context);
    }

    /**
     * Exceptional occurrences that are not errors.
     * Example: Use of deprecated APIs, poor use of an API, undesirable things
     * that are not necessarily wrong.
     *
     * @param string $message
     * @param array $context
     * @return null
     */
    public function warning($message, array $context = array())
    {
        $this->log(LogLevel::WARNING, $message, $context);
    }

    /**
     * Normal but significant events.
     *
     * @param string $message
     * @param array $context
     * @return null
     */
    public function notice($message, array $context = array())
    {
        $this->log(LogLevel::NOTICE, $message, $context);
    }

    /**
     * Interesting events.
     * Example: User logs in, SQL logs.
     *
     * @param string $message
     * @param array $context
     * @return null
     */
    public function info($message, array $context = array())
    {
        $this->log(LogLevel::INFO, $message, $context);
    }

    /**
     * Detailed debug information.
     *
     * @param string $message
     * @param array $context
     * @return null
     */
    public function debug($message, array $context = array())
    {
        $this->log(LogLevel::DEBUG, $message, $context);
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
            foreach ($this->logEntryCacheCollection as $logEntry) {
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
            $this->logEntryCacheCollection->attach(
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
        return ($level == $this->triggerLevel);
    }
}
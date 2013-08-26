<?php
/**
 * @author stev leibelt <artodeot@arcor.de>
 * @since 2013-08-26
 */

namespace Net\Bazzline\Component\LogLevelTriggered\Logger;

use Psr\Log\LoggerInterface;
use Psr\Log\LogLevel;

/**
 * Class Logger
 *
 * @package Net\Bazzline\Component\LogLevelTriggered\Logger
 * @author stev leibelt <artodeot@arcor.de>
 * @since 2013-08-26
 */
class Logger implements LoggerInterface
{
    /**
     * @var LogEntryCollection
     * @author sleibelt
     * @since 2013-08-26
     */
    protected $logCollection;

    /**
     * @var \Psr\Log\LoggerInterface
     * @author sleibelt
     * @since 2013-08-26
     */
    protected $logger;

    /**
     * @var mixed
     * @author sleibelt
     * @since 2013-08-26
     */
    protected $triggerLevel;

    /**
     * @param null $triggerLevel
     * @author sleibelt
     * @since 2013-08-26
     * @todo implement triggerLevel validation
     */
    public function __construct($triggerLevel = null)
    {
        $this->triggerLevel = (is_null($triggerLevel)) ? LogLevel::WARNING : $triggerLevel;
        $this->logCollection = new LogEntryCollection();
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
            foreach ($this->logCollection as $logEntry) {
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
            $this->logCollection->add(
                new LogEntry($level, $message, $context)
            );
        }
    }

    /**
     * @return $this
     * @author stev leibelt <artodeot@arcor.de>
     * @since 2013-08-26
     */
    public function setTriggerLevelToEmergency()
    {
        $this->triggerLevel = LogLevel::EMERGENCY;

        return $this;
    }

    /**
     * @return $this
     * @author stev leibelt <artodeot@arcor.de>
     * @since 2013-08-26
     */
    public function setTriggerLevelToAlert()
    {
        $this->triggerLevel = LogLevel::ALERT;

        return $this;
    }

    /**
     * @return $this
     * @author stev leibelt <artodeot@arcor.de>
     * @since 2013-08-26
     */
    public function setTriggerLevelToCritical()
    {
        $this->triggerLevel = LogLevel::CRITICAL;

        return $this;
    }

    /**
     * @return $this
     * @author stev leibelt <artodeot@arcor.de>
     * @since 2013-08-26
     */
    public function setTriggerLevelToError()
    {
        $this->triggerLevel = LogLevel::ERROR;

        return $this;
    }

    /**
     * @return $this
     * @author stev leibelt <artodeot@arcor.de>
     * @since 2013-08-26
     */
    public function setTriggerLevelToWarning()
    {
        $this->triggerLevel = LogLevel::WARNING;

        return $this;
    }

    /**
     * @return $this
     * @author stev leibelt <artodeot@arcor.de>
     * @since 2013-08-26
     */
    public function setTriggerLevelToNotice()
    {
        $this->triggerLevel = LogLevel::NOTICE;

        return $this;
    }

    /**
     * @return $this
     * @author stev leibelt <artodeot@arcor.de>
     * @since 2013-08-26
     */
    public function setTriggerLevelToInfo()
    {
        $this->triggerLevel = LogLevel::INFO;

        return $this;
    }

    /**
     * @return $this
     * @author stev leibelt <artodeot@arcor.de>
     * @since 2013-08-26
     */
    public function setTriggerLevelToDebug()
    {
        $this->triggerLevel = LogLevel::DEBUG;

        return $this;
    }

    /**
     * @param mixed $level
     * @return bool
     * @author stev leibelt <artodeot@arcor.de>
     * @since 2013-08-26
     */
    protected function isTriggeredLogLevel($level)
    {
        return ($level == $this->triggerLevel);
    }
}
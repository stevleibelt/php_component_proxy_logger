<?php
/**
 * @author stev leibelt <artodeot@arcor.de>
 * @since 2013-08-26
 */

namespace Net\Bazzline\Component\LogLevelTriggered\Logger;

use Psr\Log\LoggerInterface;

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
     * @var \Psr\Log\LoggerInterface
     * @author sleibelt
     * @since 2013-08-26
     */
    protected $logger;

    /**
     * Sets a logger instance on the object
     *
     * @param LoggerInterface $logger
     *
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
     *
     * @return null
     */
    public function emergency($message, array $context = array())
    {
        // TODO: Implement emergency() method.
    }

    /**
     * Action must be taken immediately.
     * Example: Entire website down, database unavailable, etc. This should
     * trigger the SMS alerts and wake you up.
     *
     * @param string $message
     * @param array $context
     *
     * @return null
     */
    public function alert($message, array $context = array())
    {
        // TODO: Implement alert() method.
    }

    /**
     * Critical conditions.
     * Example: Application component unavailable, unexpected exception.
     *
     * @param string $message
     * @param array $context
     *
     * @return null
     */
    public function critical($message, array $context = array())
    {
        // TODO: Implement critical() method.
    }

    /**
     * Runtime errors that do not require immediate action but should typically
     * be logged and monitored.
     *
     * @param string $message
     * @param array $context
     *
     * @return null
     */
    public function error($message, array $context = array())
    {
        // TODO: Implement error() method.
    }

    /**
     * Exceptional occurrences that are not errors.
     * Example: Use of deprecated APIs, poor use of an API, undesirable things
     * that are not necessarily wrong.
     *
     * @param string $message
     * @param array $context
     *
     * @return null
     */
    public function warning($message, array $context = array())
    {
        // TODO: Implement warning() method.
    }

    /**
     * Normal but significant events.
     *
     * @param string $message
     * @param array $context
     *
     * @return null
     */
    public function notice($message, array $context = array())
    {
        // TODO: Implement notice() method.
    }

    /**
     * Interesting events.
     * Example: User logs in, SQL logs.
     *
     * @param string $message
     * @param array $context
     *
     * @return null
     */
    public function info($message, array $context = array())
    {
        // TODO: Implement info() method.
    }

    /**
     * Detailed debug information.
     *
     * @param string $message
     * @param array $context
     *
     * @return null
     */
    public function debug($message, array $context = array())
    {
        // TODO: Implement debug() method.
    }

    /**
     * Logs with an arbitrary level.
     *
     * @param mixed $level
     * @param string $message
     * @param array $context
     *
     * @return null
     */
    public function log($level, $message, array $context = array())
    {
        // TODO: Implement log() method.
    }

    /**
     * @return $this
     * @author stev leibelt <artodeot@arcor.de>
     * @since 2013-08-26
     */
    public function setTriggerLevelToEmergency()
    {
        // TODO: Implement setTriggerLevelToEmergency() method.
    }

    /**
     * @return $this
     * @author stev leibelt <artodeot@arcor.de>
     * @since 2013-08-26
     */
    public function setTriggerLevelToAlert()
    {
        // TODO: Implement setTriggerLevelToAlert() method.
    }

    /**
     * @return $this
     * @author stev leibelt <artodeot@arcor.de>
     * @since 2013-08-26
     */
    public function setTriggerLevelToCritical()
    {
        // TODO: Implement setTriggerLevelToCritical() method.
    }

    /**
     * @return $this
     * @author stev leibelt <artodeot@arcor.de>
     * @since 2013-08-26
     */
    public function setTriggerLevelToError()
    {
        // TODO: Implement setTriggerLevelToError() method.
    }

    /**
     * @return $this
     * @author stev leibelt <artodeot@arcor.de>
     * @since 2013-08-26
     */
    public function setTriggerLevelToWarning()
    {
        // TODO: Implement setTriggerLevelToWarning() method.
    }

    /**
     * @return $this
     * @author stev leibelt <artodeot@arcor.de>
     * @since 2013-08-26
     */
    public function setTriggerLevelToNotice()
    {
        // TODO: Implement setTriggerLevelToNotice() method.
    }

    /**
     * @return $this
     * @author stev leibelt <artodeot@arcor.de>
     * @since 2013-08-26
     */
    public function setTriggerLevelToInfo()
    {
        // TODO: Implement setTriggerLevelToInfo() method.
    }

    /**
     * @return $this
     * @author stev leibelt <artodeot@arcor.de>
     * @since 2013-08-26
     */
    public function setTriggerLevelToDebug()
    {
        // TODO: Implement setTriggerLevelToDebug() method.
    }
}
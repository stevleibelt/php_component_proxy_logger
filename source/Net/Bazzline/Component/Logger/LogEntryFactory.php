<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-08-26 
 */

namespace Net\Bazzline\Component\Logger;

use Psr\Log\LogLevel;

/**
 * Class LogEntryFactory
 *
 * @package Net\Bazzline\Component\Logger
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-08-26
 */
class LogEntryFactory
{
    /**
     * @param $level
     * @param $message
     * @param array $context
     * @return LogEntry
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-26
     */
    public function create($level, $message, array $context = array())
    {
        $this->validateLogLevel($level);

        return new LogEntry($level, $message, $context);
    }

    /**
     * @param $level
     * @throws InvalidArgumentException
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-26
     */
    protected function validateLogLevel($level)
    {
        $validLogLevels = array(
            LogLevel::ALERT => true,
            LogLevel::CRITICAL => true,
            LogLevel::DEBUG => true,
            LogLevel::EMERGENCY => true,
            LogLevel::ERROR => true,
            LogLevel::INFO => true,
            LogLevel::NOTICE => true,
            LogLevel::WARNING => true
        );

        if (!isset($validLogLevels[$level])) {
            throw new InvalidArgumentException(
                'no valid log level provided'
            );
        }
    }
}
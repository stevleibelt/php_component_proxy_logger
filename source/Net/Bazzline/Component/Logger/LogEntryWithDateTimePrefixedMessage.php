<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-08-29
 */

namespace Net\Bazzline\Component\Logger;

/**
 * Class LogEntryWithTimestampPrefixMessage
 *
 * @package Net\Bazzline\Component\Logger
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-08-29
 */
class LogEntryWithDateTimePrefixedMessage extends LogEntry
{
    /**
     * Adds datetime as prefix to the message
     *
     * @param mixed $logLevel
     * @param string $message
     * @param array $context
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-26
     */
    public function __construct($logLevel, $message, array $context = array())
    {
        $message = '[ ' . date('Y-m-d H:i:s') . ' ]' . $message;
        parent::__construct($logLevel, $message, $context);
    }
}
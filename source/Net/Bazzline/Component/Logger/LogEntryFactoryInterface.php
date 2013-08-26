<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-08-26 
 */

namespace Net\Bazzline\Component\Logger;

/**
 * Class LogEntryFactoryInterface
 *
 * @package Net\Bazzline\Component\Logger
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-08-26
 */
interface LogEntryFactoryInterface
{
    /**
     * @param $level
     * @param $message
     * @param array $context
     * @return LogEntry
     * @throws InvalidArgumentException
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-26
     */
    public function create($level, $message, array $context = array());
}
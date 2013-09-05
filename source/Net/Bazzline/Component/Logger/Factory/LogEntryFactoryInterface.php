<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-08-26 
 */

namespace Net\Bazzline\Component\Logger\Factory;

use Net\Bazzline\Component\Logger\LogEntry\LogEntry;
use Net\Bazzline\Component\Logger\Exception\InvalidArgumentException;
use Net\Bazzline\Component\Logger\Exception\RuntimeException;

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
     * @param string $level
     * @param string $message
     * @param array $context
     * @return LogEntry
     * @throws InvalidArgumentException
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-26
     */
    public function create($level, $message, array $context = array());

    /**
     * @param string $className
     * @return $this
     * @throws InvalidArgumentException|RuntimeException
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-29
     */
    public function setLogEntryClassName($className);
}
<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 8/27/13
 */

namespace Net\Bazzline\Component\Logger\LogEntry;

/**
 * Class LogEntryRuntimeBufferFactory
 *
 * @package Net\Bazzline\Component\Logger
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-08-27
 */
class LogEntryRuntimeBufferFactory implements LogEntryBufferFactoryInterface
{
    /**
     * @return LogEntryRuntimeBuffer
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-27
     */
    public function create()
    {
        return new LogEntryRuntimeBuffer();
    }
}
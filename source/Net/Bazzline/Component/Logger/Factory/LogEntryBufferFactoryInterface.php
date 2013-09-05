<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 8/27/13
 */

namespace Net\Bazzline\Component\Logger\Factory;

use Net\Bazzline\Component\Logger\LogEntry\LogEntryBufferInterface;

/**
 * Class LogEntryRuntimeBufferFactoryInterface
 *
 * @package Net\Bazzline\Component\Logger\LogEntry
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-08-27
 */
interface LogEntryBufferFactoryInterface
{
    /**
     * @return LogEntryBufferInterface
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-27
     */
    public function create();
}
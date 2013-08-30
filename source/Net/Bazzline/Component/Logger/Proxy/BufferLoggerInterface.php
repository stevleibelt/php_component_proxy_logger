<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 8/27/13
 */

namespace Net\Bazzline\Component\Logger\Proxy;

use Net\Bazzline\Component\Logger\LogEntry\LogEntryBufferFactoryInjectInterface;
use Net\Bazzline\Component\Logger\LogEntry\LogEntryFactoryInjectInterface;

/**
 * Class BufferLoggerInterface
 *
 * @package Net\Bazzline\Component\Logger
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-08-27
 */
interface BufferLoggerInterface extends ProxyLoggerInterface, LogEntryBufferFactoryInjectInterface, LogEntryFactoryInjectInterface
{
    /**
     * Flushs buffer content to logger
     *
     * @return $this
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-27
     */
    public function flush();

    /**
     * Cleans buffer
     *
     * @return $this
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-27
     */
    public function clean();
}
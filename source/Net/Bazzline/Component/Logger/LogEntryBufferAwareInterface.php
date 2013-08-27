<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 8/27/13
 */

namespace Net\Bazzline\Component\Logger;

/**
 * Class BufferLoggerAwareInterface
 *
 * @package Net\Bazzline\Component\Logger
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-08-27
 */
interface LogEntryBufferAwareInterface
{
    /**
     * @return null|BufferLoggerInterface $buffer
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-27
     */
    public function getLogEntryBuffer();

    /**
     * @return bool
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-27
     */
    public function hasLogEntryBuffer();

    /**
     * @param LogEntryBufferInterface $buffer
     * @return $this
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-27
     */
    public function setLogEntryBuffer(LogEntryBufferInterface $buffer);
}
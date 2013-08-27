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
interface BufferLoggerAwareInterface
{
    /**
     * @return BufferLoggerInterface $buffer
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-27
     */
    public function getBufferLogger();

    /**
     * @return bool
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-27
     */
    public function hasBufferLogger();

    /**
     * @param BufferLoggerInterface $buffer
     * @return $this
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-27
     */
    public function setBufferLogger(BufferLoggerInterface $buffer);
}
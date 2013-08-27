<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 8/27/13
 */

namespace Net\Bazzline\Component\Logger;

/**
 * Class LogBuffer
 *
 * @package Net\Bazzline\Component\Logger
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-08-27
 */
class BufferedLogger extends ProxyLogger implements BufferLoggerInterface
{
    /**
     * @var LogEntryFactoryInterface
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-26
     */
    protected $logEntryFactory;

    /**
     * @var LogEntryRuntimeBuffer
     * @author sleibelt
     * @since 2013-08-26
     */
    protected $logEntryBuffer;

    /**
     * @return null|BufferLoggerInterface $buffer
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-27
     */
    public function getLogEntryBuffer()
    {
        return $this->logEntryBuffer;
    }

    /**
     * @return bool
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-27
     */
    public function hasLogEntryBuffer()
    {
        return (!is_null($this->logEntryBuffer));
    }

    /**
     * @param LogEntryBufferInterface $buffer
     * @return $this
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-27
     */
    public function setLogEntryBuffer(LogEntryBufferInterface $buffer)
    {
        $this->logEntryBuffer = $buffer;

        return $this;
    }

    /**
     * @param LogEntryFactoryInterface $factory
     * @return $this
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-26
     */
    public function injectLogEntryFactory(LogEntryFactoryInterface $factory)
    {
        $this->logEntryFactory = $factory;

        return $this;
    }
}
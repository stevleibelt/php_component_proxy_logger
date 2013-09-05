<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 8/27/13
 */

namespace Net\Bazzline\Component\Logger\Proxy;

use Net\Bazzline\Component\Logger\LogEntry\LogEntryInterface;
use Net\Bazzline\Component\Logger\LogEntry\LogEntryRuntimeBuffer;
use Net\Bazzline\Component\Logger\LogEntry\LogEntryFactoryInterface;
use Net\Bazzline\Component\Logger\LogEntry\LogEntryBufferFactoryInterface;

/**
 * Class BufferLogger
 *
 * @package Net\Bazzline\Component\Logger
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-08-27
 */
class BufferLogger extends ProxyLogger implements BufferLoggerInterface
{
    /**
     * @var LogEntryFactoryInterface
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-26
     */
    protected $logEntryFactory;

    /**
     * @var LogEntryBufferFactoryInterface
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-26
     */
    protected $logEntryBufferFactory;

    /**
     * @var LogEntryRuntimeBuffer
     * @author sleibelt
     * @since 2013-08-26
     */
    protected $logEntryBuffer;

    /**
     * Logs with an arbitrary level.
     *
     * @param mixed $level
     * @param string $message
     * @param array $context
     * @return null
     */
    public function log($level, $message, array $context = array())
    {
        $this->logEntryBuffer->attach(
            $this->logEntryFactory->create($level, $message, $context)
        );
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

    /**
     * @return null|LogEntryBufferFactoryInterface $factory
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-09-05
     */
    public function getLogEntryBufferFactory()
    {
        return $this->logEntryBufferFactory;
    }

    /**
     * @return bool
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-09-05
     */
    public function hasLogEntryBufferFactory()
    {
        return (!is_null($this->logEntryBufferFactory));
    }

    /**
     * @param LogEntryBufferFactoryInterface $factory
     * @return mixed
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-27
     */
    public function setLogEntryBufferFactory(LogEntryBufferFactoryInterface $factory)
    {
        $this->logEntryBufferFactory = $factory;
        $this->logEntryBuffer = $this->logEntryBufferFactory->create();

        return $this;
    }

    /**
     * Flushs buffer content to logger
     *
     * @return $this
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-27
     */
    public function flush()
    {
        foreach ($this->logEntryBuffer as $logEntry) {
            /**
             * @var LogEntryInterface $logEntry
             */
            $this->pushToLoggers(
                $logEntry->getLevel(),
                $logEntry->getMessage(),
                $logEntry->getContext()
            );
        }
        $this->clean();

        return $this;
    }

    /**
     * Cleans buffer
     *
     * @return $this
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-27
     */
    public function clean()
    {
        $this->logEntryBuffer = $this->logEntryBufferFactory->create();
    }
}
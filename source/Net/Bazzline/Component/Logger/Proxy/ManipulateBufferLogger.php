<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-08-26
 */

namespace Net\Bazzline\Component\Logger\Proxy;

use Net\Bazzline\Component\Logger\BufferManipulation\BypassBufferInterface;
use Net\Bazzline\Component\Logger\BufferManipulation\FlushBufferTriggerInterface;
use Net\Bazzline\Component\Logger\Factory\LogEntryFactoryInterface;

/**
 * Class ManipulateBufferLogger
 *
 * @package Net\Bazzline\Component\Logger
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-08-26
 */
class ManipulateBufferLogger extends BufferLogger implements ManipulateBufferLoggerInterface
{
    /**
     * @var mixed
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-26
     */
    protected $triggerLevel;

    /**
     * @var FlushBufferTriggerInterface
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-09-02
     */
    protected $flushBufferTrigger;

    /**
     * @var BypassBufferInterface
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-09-02
     */
    protected $avoidBufferManipulator;

    /**
     * Logs with an arbitrary level.
     *
     * @param mixed $level
     * @param string $message
     * @param array $context
     * @return null
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-26
     */
    public function log($level, $message, array $context = array())
    {
        if ($this->letItPassThrough($level)) {
            $this->pushToLoggers($level, $message, $context);
        } else {
            $this->logEntryBuffer->attach(
                $this->logEntryFactory->create($level, $message, $context)
            );

            if ($this->flushTheBuffer($level)) {
                $this->flush();
            }
        }
    }

    /**
     * @param LogEntryFactoryInterface $factory
     * @return $this
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-26
     */
    public function setLogEntryFactory(LogEntryFactoryInterface $factory)
    {
        $this->logEntryFactory = $factory;

        return $this;
    }

    /**
     * @return null|BypassBufferInterface
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-09-03
     */
    public function getAvoidBuffer()
    {
        return $this->avoidBufferManipulator;
    }

    /**
     * @return bool
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-09-03
     */
    public function hasAvoidBuffer()
    {
        return (!is_null($this->avoidBufferManipulator));
    }

    /**
     * @param BypassBufferInterface $avoidBuffer
     * @return $this
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-09-03
     */
    public function setAvoidBuffer(BypassBufferInterface $avoidBuffer)
    {
        $this->avoidBufferManipulator = $avoidBuffer;

        return $this;
    }

    /**
     * @return null|FlushBufferTriggerInterface
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-09-03
     */
    public function getFlushBufferTrigger()
    {
        return $this->flushBufferTrigger;
    }

    /**
     * @return bool
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-09-03
     */
    public function hasFlushBufferTrigger()
    {
        return (!is_null($this->flushBufferTrigger));
    }

    /**
     * @param FlushBufferTriggerInterface $flushBufferTrigger
     * @return $this
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-09-03
     */
    public function setFlushBufferTrigger(FlushBufferTriggerInterface $flushBufferTrigger)
    {
        $this->flushBufferTrigger = $flushBufferTrigger;

        return $this;
    }

    /**
     * @param $level
     * @return bool
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-09-03
     */
    protected function letItPassThrough($level)
    {
        return ($this->hasAvoidBuffer()
            && $this->avoidBufferManipulator->avoidBuffering($level));
    }

    /**
     * @param mixed $level
     * @return bool
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-26
     */
    protected function flushTheBuffer($level)
    {
        return (($level == $this->triggerLevel)
                || ($this->flushBufferTrigger->triggerBufferFlush($level)));
    }
}
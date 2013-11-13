<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 8/27/13
 */

namespace Net\Bazzline\Component\ProxyLogger\Logger;

use Net\Bazzline\Component\ProxyLogger\Event\EventInterface;
use Net\Bazzline\Component\ProxyLogger\Event\BufferEvent;
use Net\Bazzline\Component\ProxyLogger\Event\ManipulateBufferEvent;
use Net\Bazzline\Component\ProxyLogger\Event\ProxyEvent;
use Net\Bazzline\Component\ProxyLogger\LogRequest\LogRequestBufferInterface;
use Net\Bazzline\Component\ProxyLogger\Factory\LogRequestBufferFactoryInterface;

/**
 * Class BufferLogger
 *
 * @package Net\Bazzline\Component\ProxyLogger\Logger
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-08-27
 * @todo replace logRequestBufferFactory or try to remove it
 */
class BufferLogger extends AbstractLogger implements BufferLoggerInterface
{
    /**
     * @var BufferEvent
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-11-10
     */
    protected $event;

    /**
     * @var LogRequestBufferFactoryInterface
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-26
     */
    protected $logRequestBufferFactory;

    /**
     * @var LogRequestBufferInterface
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-26
     */
    protected $logRequestBuffer;

    /**
     * @return null|LogRequestBufferFactoryInterface $factory
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-09-05
     */
    public function getLogRequestBufferFactory()
    {
        return $this->logRequestBufferFactory;
    }

    /**
     * @return bool
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-09-05
     */
    public function hasLogRequestBufferFactory()
    {
        return (!is_null($this->logRequestBufferFactory));
    }

    /**
     * @param LogRequestBufferFactoryInterface $factory
     * @return mixed
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-27
     */
    public function setLogRequestBufferFactory(LogRequestBufferFactoryInterface $factory)
    {
        $this->logRequestBufferFactory = $factory;
        $this->logRequestBuffer = $this->logRequestBufferFactory->create();

        return $this;
    }

    /**
     * @return EventInterface|ProxyEvent|BufferEvent|ManipulateBufferEvent
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-11-11
     */
    public function getEvent()
    {
        return $this->event;
    }

    /**
     * @param EventInterface $event
     * @return $this
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-11-10
     */
    public function setEvent(EventInterface $event)
    {
        return $this->event = $event;
    }

    /**
     * Logs with an arbitrary level.
     *
     * @param mixed $level
     * @param string $message
     * @param array $context
     * @return null
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-27
     */
    public function log($level, $message, array $context = array())
    {
        $logRequest = $this->logRequestFactory->create($level, $message, $context);
        $this->event->setLogRequest($logRequest);
        $this->event->setLoggerCollection($this->loggers);
        $this->eventDispatcher->dispatch(BufferEvent::ADD_LOG_REQUEST_TO_BUFFER, $this->event);
    }

    /**
     * Flush buffer content to logger
     *
     * @return $this
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-27
     */
    public function flush()
    {
        $this->event->setLoggerCollection($this->loggers);
        $this->eventDispatcher->dispatch(BufferEvent::BUFFER_FLUSH, $this->event);

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
        $this->event->setLoggerCollection($this->loggers);
        $this->eventDispatcher->dispatch(BufferEvent::BUFFER_CLEAN, $this->event);

        return $this;
    }
}
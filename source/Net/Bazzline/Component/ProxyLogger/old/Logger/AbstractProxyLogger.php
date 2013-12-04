<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-11-10
 */

namespace Net\Bazzline\Component\ProxyLogger\Logger;

use Net\Bazzline\Component\ProxyLogger\Event\BufferEvent;
use Net\Bazzline\Component\ProxyLogger\Event\EventInterface;
use Net\Bazzline\Component\ProxyLogger\Event\ManipulateBufferEvent;
use Net\Bazzline\Component\ProxyLogger\Event\ProxyEvent;
use Net\Bazzline\Component\ProxyLogger\EventDispatcher\EventDispatcherInterface;
use Net\Bazzline\Component\ProxyLogger\Factory\LogRequestFactoryInterface;
use Psr\Log\LoggerInterface;

/**
 * Class AbstractProxyLogger
 *
 * @package Net\Bazzline\Component\ProxyLogger\Logger
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-11-10
 */
abstract class AbstractProxyLogger extends AbstractLogger implements AbstractProxyLoggerInterface
{
    /**
     * @var EventInterface|ProxyEvent|BufferEvent|ManipulateBufferEvent
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-11-10
     */
    protected $event;

    /**
     * @var EventDispatcherInterface
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-11-10
     */
    protected $dispatcher;

    /**
     * @var \Psr\Log\LoggerInterface[]
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-26
     */
    protected $loggers;

    /**
     * @var LogRequestFactoryInterface
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-11-10
     */
    protected $logRequestFactory;

    /**
     * @param LoggerInterface $logger
     * @return $this
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-29
     */
    public function addLogger(LoggerInterface $logger)
    {
        if (is_null($this->loggers)) {
            $this->loggers = array($logger);
        } else {
            $this->loggers[] = $logger;
        }

        return $this;
    }

    /**
     * @return null|LoggerInterface[]
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-10-23
     */
    public function getLoggers()
    {
        return $this->loggers;
    }


    /**
     * @param LogRequestFactoryInterface $factory
     * @return $this
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-26
     */
    public function setLogRequestFactory(LogRequestFactoryInterface $factory)
    {
        $this->logRequestFactory = $factory;

        return $this;
    }

    /**
     * @param EventDispatcherInterface $eventDispatcher
     * @return $this
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-11-10
     */
    public function setEventDispatcher(EventDispatcherInterface $eventDispatcher)
    {
        $this->dispatcher = $eventDispatcher;

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
        $this->event = $event;

        return $this;
    }
}
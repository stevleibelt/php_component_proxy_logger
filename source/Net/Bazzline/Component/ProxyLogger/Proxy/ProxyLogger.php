<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-08-27
 */

namespace Net\Bazzline\Component\ProxyLogger\Proxy;

use Net\Bazzline\Component\ProxyLogger\Event\BufferEvent;
use Net\Bazzline\Component\ProxyLogger\Event\EventInterface;
use Net\Bazzline\Component\ProxyLogger\Event\ManipulateBufferEvent;
use Net\Bazzline\Component\ProxyLogger\Event\ProxyEvent;

/**
 * Class AbstractProxyLogger
 *
 * @package Net\Bazzline\Component\ProxyLogger\Proxy
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-08-27
 */
class ProxyLogger extends AbstractLogger implements ProxyLoggerInterface
{
    /**
     * @var ProxyEvent
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-11-10
     */
    protected $event;

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
     */
    public function log($level, $message, array $context = array())
    {
        $logRequest = $this->logRequestFactory->create($level, $message, $context);
        $this->event->setLoggerCollection($this->loggers);
        $this->event->setLogRequest($logRequest);
        $this->eventDispatcher->dispatch(ProxyEvent::LOG_LOG_REQUEST, $this->event);
    }
}
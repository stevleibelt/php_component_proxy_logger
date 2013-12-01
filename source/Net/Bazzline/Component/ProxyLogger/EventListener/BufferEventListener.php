<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-11-08
 */

namespace Net\Bazzline\Component\ProxyLogger\EventListener;

use Net\Bazzline\Component\ProxyLogger\Event\BufferEvent;
use Net\Bazzline\Component\ProxyLogger\Event\ProxyEvent;
use Net\Bazzline\Component\ProxyLogger\EventDispatcher\EventDispatcher;

/**
 * Class BufferListener
 *
 * @package Net\Bazzline\Component\ProxyLogger\EventListener
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-11-09
 */
class BufferEventListener extends ProxyEventListener implements EventListenerInterface
{
    /**
     * @param EventDispatcher $eventDispatcher
     * @return $this
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-11-08
     */
    public function attach(EventDispatcher $eventDispatcher)
    {
        parent::attach($eventDispatcher);
        $eventDispatcher->addListener(
            BufferEvent::ADD_LOG_REQUEST_TO_BUFFER,
            array($this, 'addLogRequestToBuffer')
        );
        $eventDispatcher->addListener(
            BufferEvent::CLEAN_BUFFER,
            array($this, 'cleanBuffer')
        );
        $eventDispatcher->addListener(
            BufferEvent::FLUSH_BUFFER,
            array($this, 'flushBuffer')
        );

        return $this;
    }

    /**
     * @param EventDispatcher $eventDispatcher
     * @return $this
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-11-08
     */
    public function detach(EventDispatcher $eventDispatcher)
    {
        $eventDispatcher->removeListener(
            BufferEvent::ADD_LOG_REQUEST_TO_BUFFER,
            array($this, 'addLogRequestToBuffer')
        );
        $eventDispatcher->removeListener(
            BufferEvent::CLEAN_BUFFER, array($this, 'cleanBuffer')
        );
        $eventDispatcher->removeListener(
            BufferEvent::FLUSH_BUFFER,
            array($this, 'flushBuffer')
        );
        parent::detach($eventDispatcher);

        return $this;
    }

    /**
     * @param BufferEvent $event
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-11-09
     */
    public function addLogRequestToBuffer(BufferEvent $event)
    {
        $request = $event->getLogRequest();
        $buffer = $event->getLogRequestBuffer();
        $buffer->add($request);
    }

    /**
     * @param BufferEvent $event
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-11-09
     */
    public function cleanBuffer(BufferEvent $event)
    {
        $buffer = $event->getLogRequestBuffer();
        $clonedBuffer = clone $buffer;
        $clonedBuffer->removeAll();
        $event->setLogRequestBuffer($clonedBuffer);
    }

    /**
     * @param BufferEvent $event
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-11-09
     */
    public function flushBuffer(BufferEvent $event)
    {
        $buffer = $event->getLogRequestBuffer();
        $dispatcher = $event->getDispatcher();

        foreach ($buffer as $logRequest) {
            $event->setLogRequest($logRequest);
            $dispatcher->dispatch(BufferEvent::LOG_LOG_REQUEST, $event);
        }

        $dispatcher->dispatch(BufferEvent::CLEAN_BUFFER, $event);
    }
}
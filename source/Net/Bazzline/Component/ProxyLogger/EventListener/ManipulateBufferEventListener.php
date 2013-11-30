<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-11-09
 */

namespace Net\Bazzline\Component\ProxyLogger\EventListener;

use Net\Bazzline\Component\ProxyLogger\Event\ManipulateBufferEvent;
use Net\Bazzline\Component\ProxyLogger\EventDispatcher\EventDispatcher;

/**
 * Class ManipulateBufferListener
 *
 * @package Net\Bazzline\Component\ProxyLogger\EventListener
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-11-09
 */
class ManipulateBufferEventListener extends ProxyEventListener implements EventListenerInterface
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
            ManipulateBufferEvent::ADD_LOG_REQUEST_TO_BUFFER,
            array($this, 'addLogRequestToBuffer'),
            100
        );
        $eventDispatcher->addListener(
            ManipulateBufferEvent::BUFFER_CLEAN,
            array($this, 'bufferClean')
        );
        $eventDispatcher->addListener(
            ManipulateBufferEvent::BUFFER_FLUSH,
            array($this, 'bufferFlush')
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
            ManipulateBufferEvent::ADD_LOG_REQUEST_TO_BUFFER,
            array($this, 'addLogRequestToBuffer')
        );
        $eventDispatcher->removeListener(
            ManipulateBufferEvent::BUFFER_CLEAN, array($this, 'bufferClean')
        );
        $eventDispatcher->removeListener(
            ManipulateBufferEvent::BUFFER_FLUSH,
            array($this, 'bufferFlush')
        );
        parent::detach($eventDispatcher);

        return $this;
    }

    /**
     * @param ManipulateBufferEvent $event
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-11-09
     */
    public function addLogRequestToBuffer(ManipulateBufferEvent $event)
    {
        $buffer = $event->getLogRequestBuffer();
        $dispatcher = $event->getDispatcher();
        $logRequestWasLogged = false;
        $request = $event->getLogRequest();

        if ($event->hasBypassBuffer()) {
            $bypassBuffer = $event->getBypassBuffer();
            if ($bypassBuffer->bypassBuffer($request->getLevel())) {
                $dispatcher->dispatch(ManipulateBufferEvent::LOG_LOG_REQUEST, $event);
                $logRequestWasLogged = true;
            }
        }

        if (!$logRequestWasLogged) {
            $buffer->add($request);
        }
        if ($event->hasFlushBufferTrigger()) {
            $flushBufferTrigger = $event->getFlushBufferTrigger();
            if ($flushBufferTrigger->triggerBufferFlush($request->getLevel())) {
                $dispatcher->dispatch(ManipulateBufferEvent::BUFFER_FLUSH, $event);
            }
        }
    }

    /**
     * @param ManipulateBufferEvent $event
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-11-10
     */
    public function bufferClean(ManipulateBufferEvent $event)
    {
        $buffer = $event->getLogRequestBuffer();
        $clonedBuffer = clone $buffer;
        $event->setLogRequestBuffer($clonedBuffer);
    }

    /**
     * @param ManipulateBufferEvent $event
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-11-10
     */
    public function bufferFlush(ManipulateBufferEvent $event)
    {
        $buffer = $event->getLogRequestBuffer();
        $dispatcher = $event->getDispatcher();

        foreach ($buffer as $logRequest) {
            $event->setLogRequest($logRequest);
            $dispatcher->dispatch(ManipulateBufferEvent::LOG_LOG_REQUEST, $event);
        }

        $dispatcher->dispatch(ManipulateBufferEvent::BUFFER_CLEAN, $event);
    }
}
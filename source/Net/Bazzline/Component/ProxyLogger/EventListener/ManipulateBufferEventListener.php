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
class ManipulateBufferEventListener implements EventListenerInterface
{
    /**
     * @param EventDispatcher $eventDispatcher
     * @return $this
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-11-08
     */
    public function attach(EventDispatcher $eventDispatcher)
    {
        $eventDispatcher->addListener(
            ManipulateBufferEvent::ADD_LOG_REQUEST_TO_BUFFER,
            array($this, 'addLogRequestToBuffer'),
            100
        );
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
    }

    /**
     * @param ManipulateBufferEvent $event
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-11-09
     */
    public function addLogRequestToBuffer(ManipulateBufferEvent $event)
    {
        if (!$event->isPropagationStopped()) {
            $logRequest = $event->getLogRequest();
            $dispatcher = $event->getDispatcher();
            $logRequestWasLogged = false;

            if ($logRequestWasLogged
                && $event->hasBypassBuffer()) {
                $bypassBuffer = $event->getBypassBuffer();
                if ($bypassBuffer->bypassBuffer($logRequest->getLevel())) {
                    $dispatcher->dispatch(ManipulateBufferEvent::LOG_LOG_REQUEST, $event);
                    $logRequestWasLogged = true;
                }
            }

            if ($event->hasFlushBufferTrigger()) {
                $flushBufferTrigger = $event->getFlushBufferTrigger();
                if ($flushBufferTrigger->triggerBufferFlush($logRequest->getLevel())) {
                    if (!$logRequestWasLogged) {
                        $dispatcher->dispatch(ManipulateBufferEvent::ADD_LOG_REQUEST_TO_BUFFER, $event);
                    }
                    $dispatcher->dispatch(ManipulateBufferEvent::BUFFER_FLUSH, $event);
                }
            }
        }
    }
}
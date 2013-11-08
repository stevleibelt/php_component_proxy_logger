<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-11-09
 */

namespace Net\Bazzline\Component\ProxyLogger\EventListener;

use Net\Bazzline\Component\ProxyLogger\Event\BufferEvent;
use Net\Bazzline\Component\ProxyLogger\Event\ManipulateBufferEvent;
use Net\Bazzline\Component\ProxyLogger\Event\ProxyEvent;
use Net\Bazzline\Component\ProxyLogger\EventDispatcher\EventDispatcher;

/**
 * Class ManipulateBufferListener
 *
 * @package Net\Bazzline\Component\ProxyLogger\EventListener
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-11-09
 */
class ManipulateBufferListener implements EventListenerInterface
{
    /**
     * @param EventDispatcher $eventDispatcher
     * @return $this
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-11-08
     */
    public function attach(EventDispatcher $eventDispatcher)
    {
        $eventDispatcher->addListener(ProxyEvent::LOG_LOG_REQUEST_PRE, array($this, 'logLogRequestPre'));
    }

    /**
     * @param EventDispatcher $eventDispatcher
     * @return $this
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-11-08
     */
    public function detach(EventDispatcher $eventDispatcher)
    {
        $eventDispatcher->removeListener(ManipulateBufferEvent::LOG_LOG_REQUEST_PRE, array($this, 'logLogRequestPre'));
    }

    /**
     * @param ManipulateBufferEvent $event
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-11-09
     * @todo split this two buffer manipulators up into two to gain advantage of "stopPropagation"
     */
    public function logLogRequestPre(ManipulateBufferEvent $event)
    {
        if (!$event->isPropagationStopped()) {
            $logRequest = $event->getLogRequest();
            $dispatcher = $event->getDispatcher();
            $wasNotHandledByFlushBufferTrigger = true;

            if ($event->hasFlushBufferTrigger()) {
                $flushBufferTrigger = $event->getFlushBufferTrigger();
                if ($flushBufferTrigger->triggerBufferFlush($logRequest->getLevel())) {
                    $dispatcher->dispatch(ManipulateBufferEvent::ADD_LOG_REQUEST_TO_BUFFER, $event);
                    $dispatcher->dispatch(ManipulateBufferEvent::BUFFER_FLUSH, $event);
                    $wasNotHandledByFlushBufferTrigger = false;
                }
            }

            if ($wasNotHandledByFlushBufferTrigger
                && $event->hasBypassBuffer()) {
                $bypassBuffer = $event->getBypassBuffer();
                if ($bypassBuffer->bypassBuffer($logRequest->getLevel())) {
                    $dispatcher->dispatch(ManipulateBufferEvent::LOG_LOG_REQUEST, $event);
                }
            }
        }
    }
}
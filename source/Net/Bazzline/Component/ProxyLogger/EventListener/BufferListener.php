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
class BufferListener implements EventListenerInterface
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
            BufferEvent::ADD_LOG_REQUEST_TO_BUFFER,
            array($this, 'addLogRequestToBuffer')
        );
        $eventDispatcher->addListener(
            BufferEvent::BUFFER_CLEAN,
            array($this, 'bufferClean')
        );
        $eventDispatcher->addListener(
            BufferEvent::BUFFER_FLUSH,
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
            BufferEvent::ADD_LOG_REQUEST_TO_BUFFER,
            array($this, 'addLogRequestToBuffer')
        );
        $eventDispatcher->removeListener(
            BufferEvent::BUFFER_CLEAN, array($this, 'bufferClean')
        );
        $eventDispatcher->removeListener(
            BufferEvent::BUFFER_FLUSH,
            array($this, 'bufferFlush')
        );

        return $this;
    }

    /**
     * @param BufferEvent $event
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-11-09
     */
    public function addLogRequestToBuffer(BufferEvent $event)
    {
        if (!$event->isPropagationStopped()) {
            $request = $event->getLogRequest();
            $buffer = $event->getLogRequestBuffer();
            $buffer->add($request);
        }
    }

    /**
     * @param BufferEvent $event
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-11-09
     */
    public function bufferClean(BufferEvent $event)
    {
        if (!$event->isPropagationStopped()) {
            $buffer = $event->getLogRequestBuffer();
            $clonedBuffer = clone $buffer;
            $event->setLogRequestBuffer($clonedBuffer);
        }
    }

    /**
     * @param BufferEvent $event
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-11-09
     */
    public function bufferFlush(BufferEvent $event)
    {
        if (!$event->isPropagationStopped()) {
            $buffer = $event->getLogRequestBuffer();
            $dispatcher = $event->getDispatcher();

            foreach ($buffer as $logRequest) {
                $event->setLogRequest($logRequest);
                $dispatcher->dispatch(ProxyEvent::LOG_LOG_REQUEST, $event);
            }

            $dispatcher->dispatch(BufferEvent::BUFFER_CLEAN, $event);
        }
    }
}
<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-11-08
 */

namespace Net\Bazzline\Component\ProxyLogger\EventListener;

use Net\Bazzline\Component\ProxyLogger\Event\ProxyEvent;
use Net\Bazzline\Component\ProxyLogger\EventDispatcher\EventDispatcher;

/**
 * Class ProxyListener
 *
 * @package Net\Bazzline\Component\ProxyLogger\EventListener
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-11-08
 */
class ProxyEventListener implements EventListenerInterface
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
            ProxyEvent::LOG_LOG_REQUEST,
            array($this, 'logRequest')
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
            ProxyEvent::LOG_LOG_REQUEST,
            array($this, 'logRequest')
        );

        return $this;
    }

    /**
     * @param ProxyEvent $event
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-11-08
     */
    public function logRequest(ProxyEvent $event)
    {
        $loggerCollection = $event->getLoggerCollection();
        $logRequest = $event->getLogRequest();

        foreach ($loggerCollection as $logger) {
            $logger->log(
                $logRequest->getLevel(),
                $logRequest->getMessage(),
                $logRequest->getContext()
            );
        }
    }
}
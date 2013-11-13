<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-08-27
 */

namespace Net\Bazzline\Component\ProxyLogger\Logger;

use Net\Bazzline\Component\ProxyLogger\Event\ProxyEvent;

/**
 * Class AbstractProxyLogger
 *
 * @package Net\Bazzline\Component\ProxyLogger\Logger
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-08-27
 */
class ProxyLogger extends AbstractLogger implements ProxyLoggerInterface
{
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
        $this->dispatcher->dispatch(ProxyEvent::LOG_LOG_REQUEST, $this->event);
    }
}
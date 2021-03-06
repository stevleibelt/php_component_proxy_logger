<?php
/**
 * @author stev leibelt <artodeto@bazzline.net>
 * @since 8/27/13
 */

namespace Net\Bazzline\Component\ProxyLogger\Logger;

use Net\Bazzline\Component\ProxyLogger\Event\BufferEvent;

/**
 * Class BufferLogger
 *
 * @package Net\Bazzline\Component\ProxyLogger\Logger
 * @author stev leibelt <artodeto@bazzline.net>
 * @since 2013-08-27
 */
class BufferLogger extends AbstractProxyLogger implements BufferLoggerInterface
{
    /**
     * Logs with an arbitrary level.
     *
     * @param mixed $level
     * @param string $message
     * @param array $context
     * @return null
     * @author stev leibelt <artodeto@bazzline.net>
     * @since 2013-08-27
     */
    public function log($level, $message, array $context = array())
    {
        $logRequest = $this->logRequestFactory->create($level, $message, $context);
        $this->event->setLogRequest($logRequest);
        $this->event->setLoggerCollection($this->loggers);
        $this->dispatcher->dispatch(BufferEvent::ADD_LOG_REQUEST_TO_BUFFER, $this->event);
    }

    /**
     * Flush buffer content to logger
     *
     * @return $this
     * @author stev leibelt <artodeto@bazzline.net>
     * @since 2013-08-27
     */
    public function flush()
    {
        $this->event->setLoggerCollection($this->loggers);
        $this->dispatcher->dispatch(BufferEvent::FLUSH_BUFFER, $this->event);

        return $this;
    }

    /**
     * Cleans buffer
     *
     * @return $this
     * @author stev leibelt <artodeto@bazzline.net>
     * @since 2013-08-27
     */
    public function clean()
    {
        $this->event->setLoggerCollection($this->loggers);
        $this->dispatcher->dispatch(BufferEvent::CLEAN_BUFFER, $this->event);

        return $this;
    }
}
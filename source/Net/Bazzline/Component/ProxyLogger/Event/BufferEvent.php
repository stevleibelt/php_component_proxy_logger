<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-11-08
 */

namespace Net\Bazzline\Component\ProxyLogger\Event;

use Net\Bazzline\Component\ProxyLogger\LogRequest\LogRequestBufferInterface;
use Net\Bazzline\Component\ProxyLogger\LogRequest\LogRequestBufferAwareInterface;

/**
 * Class BufferEvent
 *
 * @package Net\Bazzline\Component\ProxyLogger\Event
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-11-08
 */
class BufferEvent extends ProxyEvent implements LogRequestBufferAwareInterface
{
    const ADD_LOG_REQUEST_TO_BUFFER = 'netBazzlineComponentProxyLoggerEvent.bufferEvent.addLogRequestToBuffer';
    const BUFFER_CLEAN = 'netBazzlineComponentProxyLoggerEvent.bufferEvent.bufferClean';
    const BUFFER_FLUSH = 'netBazzlineComponentProxyLoggerEvent.bufferEvent.bufferFlush';

    /**
     * @var LogRequestBufferInterface
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-11-08
     */
    protected $logRequestBuffer;

    /**
     * @return string
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-11-17
     */
    public function getAddLogRequestToBuffer()
    {
        return self::ADD_LOG_REQUEST_TO_BUFFER;
    }

    /**
     * @return string
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-11-17
     */
    public function getBufferClean()
    {
        return self::BUFFER_CLEAN;
    }

    /**
     * @return string
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-11-17
     */
    public function getBufferFlush()
    {
        return self::BUFFER_FLUSH;
    }

    /**
     * @return LogRequestBufferInterface
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-11-08
     */
    public function getLogRequestBuffer()
    {
        return $this->logRequestBuffer;
    }

    /**
     * @return bool
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-11-18
     */
    public function hasLogRequestBuffer()
    {
        return (!is_null($this->logRequestBuffer));
    }

    /**
     * @param LogRequestBufferInterface $logRequestBuffer
     * @return $this
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-11-08
     */
    public function setLogRequestBuffer(LogRequestBufferInterface $logRequestBuffer)
    {
        $this->logRequestBuffer = $logRequestBuffer;

        return $this;
    }
}

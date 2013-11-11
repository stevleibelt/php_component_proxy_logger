<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-11-08
 */

namespace Net\Bazzline\Component\ProxyLogger\Event;

use Net\Bazzline\Component\ProxyLogger\LogRequest\LogRequestBufferInterface;
use Net\Bazzline\Component\ProxyLogger\LogRequest\LogRequestInterface;
use Psr\Log\LoggerInterface;

/**
 * Class BufferEvent
 *
 * @package Net\Bazzline\Component\ProxyLogger\Event
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-11-08
 */
class BufferEvent extends ProxyEvent
{
    const BUFFER_FLUSH = 'bufferEvent.bufferFlush';
    const BUFFER_CLEAN = 'bufferEvent.bufferClean';
    const ADD_LOG_REQUEST_TO_BUFFER = 'bufferEvent.addLogRequestToBuffer';

    /**
     * @var LogRequestBufferInterface
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-11-08
     */
    private $logRequestBuffer;

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
     * @param LogRequestBufferInterface $logRequestBuffer
     * @return $this
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-11-08
     */
    public function setLogRequestBuffer(LogRequestBufferInterface $logRequestBuffer)
    {
        return $this->logRequestBuffer = $logRequestBuffer;
    }
}
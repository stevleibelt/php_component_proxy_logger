<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-11-08
 */

namespace Net\Bazzline\Component\ProxyLogger\Event;

use Net\Bazzline\Component\ProxyLogger\LogRequest\LogRequestBufferInterface;
use Net\Bazzline\Component\ProxyLogger\LogRequest\LogRequestInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

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
     * @param LogRequestInterface $logRequest
     * @param LoggerInterface[] $loggerCollection
     * @param LogRequestBufferInterface $logRequestBuffer
     */
    public function __construct(LogRequestInterface $logRequest, array $loggerCollection, LogRequestBufferInterface $logRequestBuffer)
    {
        parent::__construct($logRequest, $loggerCollection);
        $this->setLogRequestBuffer($logRequestBuffer);
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
<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-11-10
 */

namespace Net\Bazzline\Component\ProxyLogger\Factory;

use Net\Bazzline\Component\ProxyLogger\Event\BufferEvent;
use Net\Bazzline\Component\ProxyLogger\LogRequest\LogRequestBufferInterface;
use Net\Bazzline\Component\ProxyLogger\LogRequest\LogRequestInterface;
use Psr\Log\LoggerInterface;

/**
 * Class BufferEventFactory
 *
 * @package Net\Bazzline\Component\ProxyLogger\Factory
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-11-10
 */
class BufferEventFactory implements BufferEventFactoryInterface
{
    /**
     * @param null|array|LoggerInterface[] $loggerCollection
     * @param null|LogRequestBufferInterface $logRequestBuffer
     * @param null|LogRequestInterface $logRequest
     * @return \Net\Bazzline\Component\ProxyLogger\Event\ProxyEvent
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-11-10
     */
    public function create(array $loggerCollection = null, LogRequestBufferInterface $logRequestBuffer = null, LogRequestInterface $logRequest = null)
    {
        $event = new BufferEvent();

        if (!is_null($loggerCollection)) {
            $event->setLoggerCollection($loggerCollection);
        }

        if (!is_null($logRequestBuffer)) {
            $event->setLogRequestBuffer($logRequestBuffer);
        }

        if (!is_null($logRequest)) {
            $event->setLogRequest($logRequest);
        }

        return $event;
    }
}
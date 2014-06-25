<?php
/**
 * @author stev leibelt <artodeto@bazzline.net>
 * @since 2013-11-10
 */

namespace Net\Bazzline\Component\ProxyLogger\Factory;

use Net\Bazzline\Component\ProxyLogger\BufferManipulator\BypassBufferInterface;
use Net\Bazzline\Component\ProxyLogger\BufferManipulator\FlushBufferTriggerInterface;
use Net\Bazzline\Component\ProxyLogger\Event\ManipulateBufferEvent;
use Net\Bazzline\Component\ProxyLogger\LogRequest\LogRequestBufferInterface;
use Net\Bazzline\Component\ProxyLogger\LogRequest\LogRequestInterface;
use Psr\Log\LoggerInterface;

/**
 * Class ManipulateBufferEventFactory
 *
 * @package Net\Bazzline\Component\ProxyLogger\Factory
 * @author stev leibelt <artodeto@bazzline.net>
 * @since 2013-11-11
 */
class ManipulateBufferEventFactory implements ManipulateBufferEventFactoryInterface
{
    /**
     * @param null|array|LoggerInterface[] $loggerCollection
     * @param null|LogRequestBufferInterface $logRequestBuffer
     * @param null|LogRequestInterface $logRequest
     * @param null|FlushBufferTriggerInterface $flushBufferTrigger
     * @param null|BypassBufferInterface $bypassBuffer
     * @return \Net\Bazzline\Component\ProxyLogger\Event\ManipulateBufferEvent
     * @author stev leibelt <artodeto@bazzline.net>
     * @since 2013-11-10
     */
    public function create(array $loggerCollection = null, LogRequestBufferInterface $logRequestBuffer = null, LogRequestInterface $logRequest = null, FlushBufferTriggerInterface $flushBufferTrigger = null, BypassBufferInterface $bypassBuffer = null)
    {
        $event = new ManipulateBufferEvent();

        if (!is_null($loggerCollection)) {
            $event->setLoggerCollection($loggerCollection);
        }

        if (!is_null($logRequestBuffer)) {
            $event->setLogRequestBuffer($logRequestBuffer);
        }

        if (!is_null($logRequest)) {
            $event->setLogRequest($logRequest);
        }

        if (!is_null($bypassBuffer)) {
            $event->setBypassBuffer($bypassBuffer);
        }

        if (!is_null($flushBufferTrigger)) {
            $event->setFlushBufferTrigger($flushBufferTrigger);
        }

        return $event;
    }
}
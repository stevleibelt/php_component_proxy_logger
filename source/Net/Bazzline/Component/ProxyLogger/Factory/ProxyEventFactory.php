<?php
/**
 * @author stev leibelt <artodeto@bazzline.net>
 * @since 2013-11-10
 */

namespace Net\Bazzline\Component\ProxyLogger\Factory;

use Net\Bazzline\Component\ProxyLogger\Event\ProxyEvent;
use Net\Bazzline\Component\ProxyLogger\LogRequest\LogRequestInterface;
use Psr\Log\LoggerInterface;

/**
 * Class ProxyEventFactory
 *
 * @package Net\Bazzline\Component\ProxyLogger\Factory
 * @author stev leibelt <artodeto@bazzline.net>
 * @since 2013-11-10
 */
class ProxyEventFactory implements ProxyEventFactoryInterface
{
    /**
     * @param null|array|LoggerInterface[] $loggerCollection
     * @param null|LogRequestInterface $logRequest
     * @return \Net\Bazzline\Component\ProxyLogger\Event\ProxyEvent
     * @author stev leibelt <artodeto@bazzline.net>
     * @since 2013-11-10
     */
    public function create(array $loggerCollection = null, LogRequestInterface $logRequest = null)
    {
        $event = new ProxyEvent();

        if (!is_null($loggerCollection)) {
            $event->setLoggerCollection($loggerCollection);
        }

        if (!is_null($logRequest)) {
            $event->setLogRequest($logRequest);
        }

        return $event;
    }
}
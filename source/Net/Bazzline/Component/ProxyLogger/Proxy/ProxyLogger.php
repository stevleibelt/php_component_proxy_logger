<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-08-27
 */

namespace Net\Bazzline\Component\ProxyLogger\Proxy;

use Net\Bazzline\Component\ProxyLogger\Event\ProxyEvent;
use Net\Bazzline\Component\ProxyLogger\Factory\ProxyEventFactoryInterface;

/**
 * Class AbstractProxyLogger
 *
 * @package Net\Bazzline\Component\ProxyLogger\Proxy
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-08-27
 */
class ProxyLogger extends AbstractLogger implements ProxyLoggerInterface
{
    /**
     * @var ProxyEventFactoryInterface
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-11-10
     */
    protected $proxyEventFactory;

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
        $event = $this->proxyEventFactory->create($this->loggers, $logRequest);
        $this->eventDispatcher->dispatch(ProxyEvent::LOG_LOG_REQUEST, $event);
    }

    /**
     * @param ProxyEventFactoryInterface $factory
     * @return $this
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-11-10
     */
    public function setProxyEventFactory(ProxyEventFactoryInterface $factory)
    {
        return $this->proxyEventFactory = $factory;
    }
}
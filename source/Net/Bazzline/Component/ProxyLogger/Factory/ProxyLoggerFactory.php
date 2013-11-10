<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-09-08 
 */

namespace Net\Bazzline\Component\ProxyLogger\Factory;

use Net\Bazzline\Component\ProxyLogger\EventDispatcher\EventDispatcher;
use Net\Bazzline\Component\ProxyLogger\EventListener\ProxyEventListener;
use Net\Bazzline\Component\ProxyLogger\Proxy\ProxyLogger;
use Psr\Log\LoggerInterface;

/**
 * Class ProxyLoggerFactory
 *
 * @package Net\Bazzline\Component\ProxyLogger\Factory
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-09-08
 */
class ProxyLoggerFactory implements ProxyLoggerFactoryInterface
{
    /**
     * @param LoggerInterface $logger
     * @return \Net\Bazzline\Component\ProxyLogger\Proxy\ProxyLoggerInterface
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-09-09
     */
    public function create(LoggerInterface $logger)
    {
        $proxyLogger = new ProxyLogger();
        $proxyEventFactory = new ProxyEventFactory();
        $logRequestFactory = new LogRequestFactory();
        $dispatcher = new EventDispatcher();
        $listener = new ProxyEventListener();
        $listener->attach($dispatcher);

        $proxyLogger->addLogger($logger);
        $proxyLogger->setProxyEventFactory($proxyEventFactory);
        $proxyLogger->setEventDispatcher($dispatcher);
        $proxyLogger->setLogRequestFactory($logRequestFactory);

        return $proxyLogger;
    }
}
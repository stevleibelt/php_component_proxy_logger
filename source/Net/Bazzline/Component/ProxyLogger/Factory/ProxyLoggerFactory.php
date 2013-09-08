<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-09-08 
 */

namespace Net\Bazzline\Component\ProxyLogger\Factory;

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
        $proxyLogger->addLogger($logger);

        return $proxyLogger;
    }
}
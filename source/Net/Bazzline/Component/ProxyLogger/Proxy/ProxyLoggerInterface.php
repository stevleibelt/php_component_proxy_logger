<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-08-26
 */

namespace Net\Bazzline\Component\ProxyLogger\Proxy;

use Net\Bazzline\Component\ProxyLogger\Event\EventDependInterface;
use Psr\Log\LoggerInterface;

/**
 * Class ProxyLoggerInterface
 * based on: http://en.wikipedia.org/wiki/Proxy_pattern
 *
 * @package Net\Bazzline\Component\ProxyLogger\Proxy
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-08-26
 */
interface ProxyLoggerInterface extends LoggerInterface, EventDependInterface
{
    /**
     * @param LoggerInterface $logger
     * @return $this
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-29
     */
    public function addLogger(LoggerInterface $logger);

    /**
     * @return null|LoggerInterface[]
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-10-23
     */
    public function getLoggers();
}
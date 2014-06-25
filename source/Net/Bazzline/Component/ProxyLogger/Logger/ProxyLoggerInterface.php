<?php
/**
 * @author stev leibelt <artodeto@bazzline.net>
 * @since 2013-08-26
 */

namespace Net\Bazzline\Component\ProxyLogger\Logger;

use Net\Bazzline\Component\ProxyLogger\Event\EventAwareInterface;
use Psr\Log\LoggerInterface;

/**
 * Class ProxyLoggerInterface
 * based on: http://en.wikipedia.org/wiki/Proxy_pattern
 *
 * @package Net\Bazzline\Component\ProxyLogger\Logger
 * @author stev leibelt <artodeto@bazzline.net>
 * @since 2013-08-26
 */
interface ProxyLoggerInterface extends EventAwareInterface, AbstractProxyLoggerInterface
{
    /**
     * @param LoggerInterface $logger
     * @return $this
     * @author stev leibelt <artodeto@bazzline.net>
     * @since 2013-08-29
     */
    public function addLogger(LoggerInterface $logger);

    /**
     * @return null|LoggerInterface[]
     * @author stev leibelt <artodeto@bazzline.net>
     * @since 2013-10-23
     */
    public function getLoggers();
}
<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-08-26
 */

namespace Net\Bazzline\Component\Logger;

use Psr\Log\LoggerAwareInterface;
use Psr\Log\LoggerInterface;

/**
 * Class ProxyLoggerInterface
 * based on: http://en.wikipedia.org/wiki/Proxy_pattern
 *
 * @package Net\Bazzline\Component\Logger
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-08-26
 */
interface ProxyLoggerInterface extends LoggerInterface
{
    /**
     * @param LoggerInterface $logger
     * @return $this
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-29
     */
    public function addLogger(LoggerInterface $logger);
}
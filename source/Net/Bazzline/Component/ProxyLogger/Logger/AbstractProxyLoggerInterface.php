<?php
/**
 * @author stev leibelt <artodeto@bazzline.net>
 * @since 2013-11-10
 */

namespace Net\Bazzline\Component\ProxyLogger\Logger;

use Net\Bazzline\Component\ProxyLogger\EventDispatcher\EventDispatcherDependInterface;
use Net\Bazzline\Component\ProxyLogger\Factory\LogRequestFactoryDependInterface;
use Psr\Log\LoggerInterface;

/**
 * Interface AbstractProxyLoggerInterface
 *
 * @package Net\Bazzline\Component\ProxyLogger\Logger
 * @author stev leibelt <artodeto@bazzline.net>
 * @since 2013-11-10
 */
interface AbstractProxyLoggerInterface extends LoggerInterface, LogRequestFactoryDependInterface, EventDispatcherDependInterface
{
} 
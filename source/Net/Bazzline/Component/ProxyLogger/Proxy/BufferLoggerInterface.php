<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 8/27/13
 */

namespace Net\Bazzline\Component\ProxyLogger\Proxy;

use Net\Bazzline\Component\ProxyLogger\EventDispatcher\EventDispatcherDependInterface;
use Net\Bazzline\Component\ProxyLogger\Factory\BufferEventFactoryDependInterface;
use Net\Bazzline\Component\ProxyLogger\Factory\LogRequestBufferFactoryDependInterface;
use Net\Bazzline\Component\ProxyLogger\Factory\LogRequestFactoryDependInterface;
use Psr\Log\LoggerInterface;

/**
 * Class BufferLoggerInterface
 *
 * @package Net\Bazzline\Component\ProxyLogger\Proxy
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-08-27
 */
interface BufferLoggerInterface extends LoggerInterface, BufferEventFactoryDependInterface, EventDispatcherDependInterface, LogRequestBufferFactoryDependInterface, LogRequestFactoryDependInterface
{
    /**
     * Flushs buffer content to logger
     *
     * @return $this
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-27
     */
    public function flush();

    /**
     * Cleans buffer
     *
     * @return $this
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-27
     */
    public function clean();
}
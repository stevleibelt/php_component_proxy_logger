<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-10-25
 */

namespace Net\Bazzline\Component\ProxyLogger\Factory;

/**
 * Class DefaultBufferLoggerFactory
 *
 * @package Net\Bazzline\Component\ProxyLogger\Factory
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-10-25
 */
class DefaultBufferLoggerFactory extends BufferLoggerFactory
{
    /**
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-10-25
     */
    public function __construct()
    {
        $this->setLogRequestFactory(new LogRequestFactory());
        $this->setLogRequestBufferFactory(new LogRequestRuntimeBufferFactory());
    }
} 
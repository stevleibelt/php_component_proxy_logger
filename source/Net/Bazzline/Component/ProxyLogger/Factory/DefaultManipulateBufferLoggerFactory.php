<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-10-25
 */

namespace Net\Bazzline\Component\ProxyLogger\Factory;

/**
 * Class DefaultManipulateBufferLoggerFactory
 *
 * @package Net\Bazzline\Component\ProxyLogger\Factory
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-10-25
 */
class DefaultManipulateBufferLoggerFactory extends ManipulateBufferLoggerFactory
{
    /**
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-10-25
     */
    public function __construct()
    {
        $this->setBypassBufferFactory(new BypassBufferFactory());
        $this->setFlushBufferTriggerFactory(new UpwardFlushBufferTriggerFactory());
        $this->setLogRequestFactory(new LogRequestFactory());
        $this->setLogRequestBufferFactory(new LogRequestRuntimeBufferFactory());
    }
} 
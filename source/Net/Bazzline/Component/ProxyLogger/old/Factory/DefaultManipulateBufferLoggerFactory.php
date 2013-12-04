<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-10-25
 */

namespace Net\Bazzline\Component\ProxyLogger\Factory;

use Net\Bazzline\Component\ProxyLogger\Validator\IsValidLogLevel;

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
        $isValidLogLevel = new IsValidLogLevel();
        $logRequestFactory = new LogRequestFactory();
        $logRequestFactory->setIsValidLogLevel($isValidLogLevel);

        $this->setBypassBufferFactory(new BypassBufferFactory());
        $this->setFlushBufferTriggerFactory(new UpwardFlushBufferTriggerFactory());
        $this->setLogRequestFactory($logRequestFactory);
        $this->setLogRequestBufferFactory(new LogRequestRuntimeBufferFactory());
    }
} 
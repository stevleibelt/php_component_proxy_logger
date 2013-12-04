<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-10-25
 */

namespace Net\Bazzline\Component\ProxyLogger\Factory;

use Net\Bazzline\Component\ProxyLogger\Validator\IsValidLogLevel;

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
        $logRequestFactory = new LogRequestFactory();
        $logRequestFactory->setIsValidLogLevel(new IsValidLogLevel());
        $this->setLogRequestFactory($logRequestFactory);
        $this->setLogRequestBufferFactory(new LogRequestRuntimeBufferFactory());
    }
} 
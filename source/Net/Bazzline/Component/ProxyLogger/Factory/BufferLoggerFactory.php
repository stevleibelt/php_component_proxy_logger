<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-09-08 
 */

namespace Net\Bazzline\Component\ProxyLogger\Factory;

use Net\Bazzline\Component\ProxyLogger\Proxy\BufferLogger;
use Psr\Log\LoggerInterface;

/**
 * Class BufferLoggerFactory
 *
 * @package Net\Bazzline\Component\ProxyLogger\Factory
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-09-08
 */
class BufferLoggerFactory implements BufferLoggerFactoryInterface
{
    /**
     * @var LogRequestFactoryInterface
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-10-10
     */
    protected $logRequestFactory;

    /**
     * @var LogRequestBufferFactoryInterface
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-10-10
     */
    protected $logRequestBufferFactory;

    /**
     * If not provided, following factories are used as default.
     *  - LogRequestFactory with log request class name of LogRequest
     *  - LogRequestRuntimeBufferFactory
     *
     * @param LoggerInterface $logger
     * @return \Net\Bazzline\Component\ProxyLogger\Proxy\BufferLoggerInterface
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-09-08
     */
    public function create(LoggerInterface $logger)
    {
        $bufferLogger = new BufferLogger();

        if ($this->hasLogRequestFactory()) {
            $logRequestFactory = $this->logRequestBufferFactory;
        } else {
            $logRequestFactory = new LogRequestFactory();
            $logRequestFactory->setLogRequestClassName('LogRequest');
        }

        if ($this->hasLogRequestBufferFactory()) {
            $logRequestBufferFactory = $this->logRequestBufferFactory;
        } else {
            $logRequestBufferFactory = new LogRequestRuntimeBufferFactory();
        }

        $bufferLogger->addLogger($logger);
        $bufferLogger->setLogRequestFactory($logRequestFactory);
        $bufferLogger->setLogRequestBufferFactory($logRequestBufferFactory);

        return $bufferLogger;
    }

    /**
     * @return null|LogRequestBufferFactoryInterface $factory
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-09-05
     */
    public function getLogRequestBufferFactory()
    {
        return $this->logRequestBufferFactory;
    }

    /**
     * @return bool
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-09-05
     */
    public function hasLogRequestBufferFactory()
    {
        return (!is_null($this->logRequestBufferFactory));
    }

    /**
     * @param LogRequestBufferFactoryInterface $factory
     * @return mixed
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-27
     */
    public function setLogRequestBufferFactory(LogRequestBufferFactoryInterface $factory)
    {
        $this->logRequestBufferFactory = $factory;

        return $this;
    }

    /**
     * @return null|LogRequestFactoryInterface $factory
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-09-05
     */
    public function getLogRequestFactory()
    {
        return $this->logRequestFactory;
    }

    /**
     * @return bool
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-09-05
     */
    public function hasLogRequestFactory()
    {
        return (!is_null($this->logRequestFactory));
    }

    /**
     * @param LogRequestFactoryInterface $factory
     * @return $this
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-26
     */
    public function setLogRequestFactory(LogRequestFactoryInterface $factory)
    {
        $this->logRequestFactory = $factory;

        return $this;
    }
}
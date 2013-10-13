<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-08-26 
 */

namespace Net\Bazzline\Component\ProxyLogger\Factory;

use Net\Bazzline\Component\ProxyLogger\BufferManipulator\BypassBufferInterface;
use Net\Bazzline\Component\ProxyLogger\BufferManipulator\FlushBufferTriggerInterface;
use Net\Bazzline\Component\ProxyLogger\Proxy\ManipulateBufferLogger;
use Psr\Log\LoggerInterface;

/**
 * Class ManipulateBufferLoggerFactory
 *
 * @package Net\Bazzline\Component\ProxyLogger\Factory
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-08-26
 */
class ManipulateBufferLoggerFactory extends BufferLoggerFactory implements ManipulateBufferLoggerFactoryInterface
{
    /**
     * @var BypassBufferInterface
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-10-13
     */
    protected $bypassBuffer;

    /**
     * @var FlushBufferTriggerInterface
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-10-13
     */
    protected $flushBufferTrigger;

    /**
     * If not provided, following factories are used as default.
     *  - LogRequestFactory with log request class name of LogRequest
     *  - LogRequestRuntimeBufferFactory
     *
     * @param LoggerInterface $logger
     * @return \Net\Bazzline\Component\ProxyLogger\Proxy\ManipulateBufferLoggerInterface
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-26
     */
    public function create(LoggerInterface $logger)
    {
        $manipulateBufferLogger = new ManipulateBufferLogger();

        if ($this->hasLogRequestFactory()) {
            $logRequestFactory = $this->logRequestFactory;
        } else {
            $logRequestFactory = new LogRequestFactory();
            $logRequestFactory->setLogRequestClassName('LogRequest');
        }

        if ($this->hasLogRequestBufferFactory()) {
            $logRequestBufferFactory = $this->logRequestBufferFactory;
        } else {
            $logRequestBufferFactory = new LogRequestRuntimeBufferFactory();
        }

        $manipulateBufferLogger->addLogger($logger);
        $manipulateBufferLogger->setLogRequestFactory($logRequestFactory);
        $manipulateBufferLogger->setLogRequestBufferFactory($logRequestBufferFactory);

        if ($this->hasFlushBufferTrigger()) {
            $manipulateBufferLogger->setFlushBufferTrigger($this->flushBufferTrigger);
        }

        if ($this->hasBypassBuffer()) {
            $manipulateBufferLogger->setBypassBuffer($this->bypassBuffer);
        }

        return $manipulateBufferLogger;
    }

    /**
     * @return null|BypassBufferInterface
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-09-03
     */
    public function getBypassBuffer()
    {
        return $this->bypassBuffer;
    }

    /**
     * @return bool
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-09-03
     */
    public function hasBypassBuffer()
    {
        return (!is_null($this->bypassBuffer));
    }

    /**
     * @param BypassBufferInterface $bypassBuffer
     * @return $this
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-09-03
     */
    public function setBypassBuffer(BypassBufferInterface $bypassBuffer)
    {
        $this->bypassBuffer = $bypassBuffer;

        return $this;
    }

    /**
     * @return null|FlushBufferTriggerInterface
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-09-03
     */
    public function getFlushBufferTrigger()
    {
        return $this->flushBufferTrigger;
    }

    /**
     * @return bool
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-09-03
     */
    public function hasFlushBufferTrigger()
    {
        return (!is_null($this->flushBufferTrigger));
    }

    /**
     * @param FlushBufferTriggerInterface $flushBufferTrigger
     * @return $this
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-09-03
     */
    public function setFlushBufferTrigger(FlushBufferTriggerInterface $flushBufferTrigger)
    {
        $this->flushBufferTrigger = $flushBufferTrigger;

        return $this;
    }
}

<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-08-26 
 */

namespace Net\Bazzline\Component\ProxyLogger\Factory;

use Net\Bazzline\Component\ProxyLogger\BufferManipulator\BypassBufferInterface;
use Net\Bazzline\Component\ProxyLogger\BufferManipulator\FlushBufferTriggerInterface;
use Net\Bazzline\Component\ProxyLogger\Event\ManipulateBufferEvent;
use Net\Bazzline\Component\ProxyLogger\EventDispatcher\EventDispatcher;
use Net\Bazzline\Component\ProxyLogger\EventListener\ManipulateBufferEventListener;
use Net\Bazzline\Component\ProxyLogger\Proxy\BufferLogger;
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
     * @var BypassBufferFactoryInterface
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-10-13
     */
    protected $bypassBufferFactory;

    /**
     * @var FlushBufferTriggerFactoryInterface
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-10-13
     */
    protected $flushBufferTriggerFactory;

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
        $bufferLogger = new BufferLogger();
        $event = new ManipulateBufferEvent();
        $dispatcher = new EventDispatcher();
        $listener = new ManipulateBufferEventListener();
        $listener->attach($dispatcher);

        if ($this->hasFlushBufferTriggerFactory()) {
            $flushBufferTrigger = $this->flushBufferTriggerFactory->create();
            $event->setFlushBufferTrigger($flushBufferTrigger);
        }

        if ($this->hasBypassBufferFactory()) {
            $bypassBuffer = $this->bypassBufferFactory->create();
            $event->setBypassBuffer($bypassBuffer);
        }

        $buffer = $this->logRequestBufferFactory->create();
        $event->setLogRequestBuffer($buffer);

        $bufferLogger->addLogger($logger);
        $bufferLogger->setLogRequestFactory($this->logRequestFactory);
        $bufferLogger->setEvent($event);
        $bufferLogger->setEventDispatcher($dispatcher);

        return $bufferLogger;
    }

    /**
     * @return null|BypassBufferInterface
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-09-03
     */
    public function getBypassBufferFactory()
    {
        return $this->bypassBufferFactory;
    }

    /**
     * @return bool
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-09-03
     */
    public function hasBypassBufferFactory()
    {
        return (!is_null($this->bypassBufferFactory));
    }

    /**
     * @param BypassBufferFactoryInterface $factory
     * @return $this
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-09-03
     */
    public function setBypassBufferFactory(BypassBufferFactoryInterface $factory)
    {
        return $this->bypassBufferFactory = $factory;
    }

    /**
     * @return null|FlushBufferTriggerInterface
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-09-03
     */
    public function getFlushBufferTriggerFactory()
    {
        return $this->flushBufferTriggerFactory;
    }

    /**
     * @return bool
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-09-03
     */
    public function hasFlushBufferTriggerFactory()
    {
        return (!is_null($this->flushBufferTriggerFactory));
    }

    /**
     * @param FlushBufferTriggerFactoryInterface $factory
     * @return $this
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-09-03
     */
    public function setFlushBufferTriggerFactory(FlushBufferTriggerFactoryInterface $factory)
    {
        return $this->flushBufferTriggerFactory = $factory;
    }
}

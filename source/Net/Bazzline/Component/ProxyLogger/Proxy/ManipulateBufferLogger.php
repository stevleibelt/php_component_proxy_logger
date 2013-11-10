<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-08-26
 */

namespace Net\Bazzline\Component\ProxyLogger\Proxy;

use Net\Bazzline\Component\ProxyLogger\BufferManipulator\BypassBufferInterface;
use Net\Bazzline\Component\ProxyLogger\BufferManipulator\FlushBufferTriggerInterface;
use Net\Bazzline\Component\ProxyLogger\Event\ManipulateBufferEvent;
use Net\Bazzline\Component\ProxyLogger\Factory\LogRequestBufferFactoryInterface;
use Net\Bazzline\Component\ProxyLogger\Factory\LogRequestFactoryInterface;
use Net\Bazzline\Component\ProxyLogger\Factory\ManipulateBufferEventFactoryInterface;
use Net\Bazzline\Component\ProxyLogger\LogRequest\LogRequestBufferInterface;

/**
 * Class ManipulateBufferLogger
 *
 * @package Net\Bazzline\Component\ProxyLogger\Proxy
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-08-26
 */
class ManipulateBufferLogger extends AbstractLogger implements ManipulateBufferLoggerInterface
{
    /**
     * @var ManipulateBufferEventFactoryInterface
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-11-10
     */
    protected $manipulateBufferEventFactory;

    /**
     * @var LogRequestBufferFactoryInterface
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-26
     */
    protected $logRequestBufferFactory;

    /**
     * @var LogRequestBufferInterface
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-26
     */
    protected $logRequestBuffer;

    /**
     * @var FlushBufferTriggerInterface
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-09-02
     */
    protected $flushBufferTrigger;

    /**
     * @var BypassBufferInterface
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-09-02
     */
    protected $bypassBuffer;

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

    /**
     * @param LogRequestBufferFactoryInterface $factory
     * @return mixed
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-27
     */
    public function setLogRequestBufferFactory(LogRequestBufferFactoryInterface $factory)
    {
        $this->logRequestBufferFactory = $factory;
        $this->logRequestBuffer = $this->logRequestBufferFactory->create();

        return $this;
    }

    /**
     * @param ManipulateBufferEventFactoryInterface $factory
     * @return $this
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-10-11
     */
    public function setManipulateBufferEventFactory(ManipulateBufferEventFactoryInterface $factory)
    {
        $this->manipulateBufferEventFactory = $factory;
    }

    /**
     * Logs with an arbitrary level.
     *
     * @param mixed $level
     * @param string $message
     * @param array $context
     * @return null
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-26
     */
    public function log($level, $message, array $context = array())
    {
        $logRequest = $this->logRequestFactory->create($level, $message, $context);
        $event = $this->manipulateBufferEventFactory->create($this->loggers, $this->logRequestBuffer, $logRequest);
        $this->eventDispatcher->dispatch(ManipulateBufferEvent::ADD_LOG_REQUEST_TO_BUFFER, $event);
    }

    /**
     * Flushs buffer content to logger
     *
     * @return $this
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-27
     */
    public function flush()
    {
        $event = $this->manipulateBufferEventFactory->create($this->loggers, $this->logRequestBuffer);
        $this->eventDispatcher->dispatch(ManipulateBufferEvent::BUFFER_FLUSH, $event);

        return $this;
    }

    /**
     * Cleans buffer
     *
     * @return $this
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-27
     */
    public function clean()
    {
        $this->logRequestBuffer = $this->logRequestBufferFactory->create();
        $event = $this->manipulateBufferEventFactory->create($this->loggers, $this->logRequestBuffer);
        $this->eventDispatcher->dispatch(ManipulateBufferEvent::BUFFER_CLEAN, $event);

        return $this;
    }
}
<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 8/27/13
 */

namespace Net\Bazzline\Component\ProxyLogger\Proxy;

use Net\Bazzline\Component\ProxyLogger\Event\BufferEvent;
use Net\Bazzline\Component\ProxyLogger\Factory\BufferEventFactoryInterface;
use Net\Bazzline\Component\ProxyLogger\LogRequest\LogRequestRuntimeBuffer;
use Net\Bazzline\Component\ProxyLogger\Factory\LogRequestBufferFactoryInterface;

/**
 * Class BufferLogger
 *
 * @package Net\Bazzline\Component\ProxyLogger\Proxy
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-08-27
 */
class BufferLogger extends AbstractLogger implements BufferLoggerInterface
{
    /**
     * @var BufferEventFactoryInterface
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-11-10
     */
    protected $bufferEventFactory;

    /**
     * @var LogRequestBufferFactoryInterface
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-26
     */
    protected $logRequestBufferFactory;

    /**
     * @var LogRequestRuntimeBuffer
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-26
     */
    protected $logRequestBuffer;

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
        $this->logRequestBuffer = $this->logRequestBufferFactory->create();

        return $this;
    }

    /**
     * @param BufferEventFactoryInterface $factory
     * @return $this
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-11-10
     */
    public function setBufferEventFactory(BufferEventFactoryInterface $factory)
    {
        return $this->bufferEventFactory = $factory;
    }

    /**
     * Logs with an arbitrary level.
     *
     * @param mixed $level
     * @param string $message
     * @param array $context
     * @return null
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-27
     */
    public function log($level, $message, array $context = array())
    {
        $logRequest = $this->logRequestFactory->create($level, $message, $context);
        $event = $this->bufferEventFactory->create($this->loggers, $this->logRequestBuffer, $logRequest);
        $this->eventDispatcher->dispatch(BufferEvent::ADD_LOG_REQUEST_TO_BUFFER, $event);
    }

    /**
     * Flush buffer content to logger
     *
     * @return $this
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-27
     */
    public function flush()
    {
        $event = $this->bufferEventFactory->create($this->loggers, $this->logRequestBuffer);
        $this->eventDispatcher->dispatch(BufferEvent::BUFFER_FLUSH, $event);

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
        $event = $this->bufferEventFactory->create($this->loggers, $this->logRequestBuffer);
        $this->eventDispatcher->dispatch(BufferEvent::BUFFER_CLEAN, $event);

        return $this;
    }
}
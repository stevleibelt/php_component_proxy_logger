<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-09-08 
 */

namespace Net\Bazzline\Component\ProxyLogger\Factory;

use Net\Bazzline\Component\ProxyLogger\Event\BufferEvent;
use Net\Bazzline\Component\ProxyLogger\EventDispatcher\EventDispatcher;
use Net\Bazzline\Component\ProxyLogger\EventListener\BufferEventListener;
use Net\Bazzline\Component\ProxyLogger\Logger\BufferLogger;
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
     * @return \Net\Bazzline\Component\ProxyLogger\Logger\BufferLoggerInterface
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-09-08
     */
    public function create(LoggerInterface $logger)
    {
        $bufferLogger = new BufferLogger();
        $event = new BufferEvent();
        $dispatcher = new EventDispatcher();
        $listener = new BufferEventListener();
        $listener->attach($dispatcher);
        $buffer = $this->logRequestBufferFactory->create();
        $event->setLogRequestBuffer($buffer);

        $bufferLogger->addLogger($logger);
        $bufferLogger->setLogRequestFactory($this->logRequestFactory);
        $bufferLogger->setEvent($event);
        $bufferLogger->setEventDispatcher($dispatcher);

        return $bufferLogger;
    }

    /**
     * @param LogRequestBufferFactoryInterface $factory
     * @return mixed
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-27
     */
    public function setLogRequestBufferFactory(LogRequestBufferFactoryInterface $factory)
    {
        return $this->logRequestBufferFactory = $factory;
    }

    /**
     * @param LogRequestFactoryInterface $factory
     * @return $this
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-26
     */
    public function setLogRequestFactory(LogRequestFactoryInterface $factory)
    {
        return $this->logRequestFactory = $factory;
    }
}
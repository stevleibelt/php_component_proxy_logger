<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 8/27/13
 */

namespace Test\Net\Bazzline\Component\ProxyLogger\Logger;

use Net\Bazzline\Component\ProxyLogger\Event\BufferEvent;
use Net\Bazzline\Component\ProxyLogger\Logger\BufferLogger;
use Mockery;
use Psr\Log\LogLevel;
use Test\Net\Bazzline\Component\ProxyLogger\TestCase;

/**
 * Class BufferLoggerTest
 *
 * @package Test\Net\Bazzline\Component\ProxyLogger
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-08-27
 */
class BufferLoggerTest extends TestCase
{
    /**
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-27
     */
    public function testLog()
    {
        $level = LogLevel::WARNING;
        $message = 'the message is love';
        $request = $this->getNewLogRequestMock();
        $buffer = $this->getNewLogRequestRuntimeBufferMock($request);
        $event = $this->getNewEventMock();
        $event->shouldReceive('setLogRequest')
            ->once();
        $event->shouldReceive('setLoggerCollection')
            ->once();
        $eventDispatcher = $this->getNewEventDispatcherMock();
        $eventDispatcher->shouldReceive('dispatch')
            ->with(BufferEvent::ADD_LOG_REQUEST_TO_BUFFER, $event)
            ->once();

        $logger = $this->getNewLogger();
        $logger->setEvent($event);
        $logger->setEventDispatcher($eventDispatcher);
        $logger->setLogRequestFactory($this->getNewLogRequestFactoryMock($request));

        $logger->log($level, $message);
    }

    /**
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-27
     */
    public function testClean()
    {
        $request = $this->getNewLogRequestMock();
        $requestFactory = $this->getNewLogRequestFactoryMock($request);
        $requestFactory->shouldReceive('create')
            ->never();
        $event = $this->getNewEventMock();
        $event->shouldReceive('setLoggerCollection')
            ->once();
        $eventDispatcher = $this->getNewEventDispatcherMock();
        $eventDispatcher->shouldReceive('dispatch')
            ->with(BufferEvent::CLEAN_BUFFER, $event)
            ->once();

        $logger = $this->getNewLogger();
        $logger->setEvent($event);
        $logger->setEventDispatcher($eventDispatcher);
        $logger->setLogRequestFactory($requestFactory);

        $logger->clean();
    }

    /**
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-27
     */
    public function testFlushWithNoLogRequest()
    {
        $request = $this->getNewLogRequestMock();
        $event = $this->getNewEventMock();
        $event->shouldReceive('setLoggerCollection')
            ->once();
        $dispatcher = $this->getNewEventDispatcherMock();
        $dispatcher->shouldReceive('dispatch')
            ->with(BufferEvent::FLUSH_BUFFER, $event)
            ->once();
        $factory = $this->getNewLogRequestFactoryMock($request);
        $factory->shouldReceive('create')
            ->never();

        $logger = $this->getNewLogger();
        $logger->setEvent($event);
        $logger->setEventDispatcher($dispatcher);
        $logger->setLogRequestFactory($factory);

        $logger->flush();
    }

    /**
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-27
     */
    public function testFlushWithLogRequest()
    {
        $level = LogLevel::WARNING;
        $message = 'the message is love';
        $request = $this->getNewLogRequestMock();
        $event = $this->getNewEventMock();
        $event->shouldReceive('setLogRequest')
            ->once();
        $event->shouldReceive('setLoggerCollection')
            ->twice();
        $dispatcher = $this->getNewEventDispatcherMock();
        $dispatcher->shouldReceive('dispatch')
            ->with(BufferEvent::ADD_LOG_REQUEST_TO_BUFFER, $event)
            ->once();
        $dispatcher->shouldReceive('dispatch')
            ->with(BufferEvent::FLUSH_BUFFER, $event)
            ->once();
        $factory = $this->getNewLogRequestFactoryMock($request);
        $realLogger = $this->getNewPsr3LoggerMock();

        $logger = $this->getNewLogger();
        $logger->setEvent($event);
        $logger->setEventDispatcher($dispatcher);
        $logger->addLogger($realLogger);
        $logger->setLogRequestFactory($factory);

        $logger->log($level, $message);
        $logger->flush();
    }

    /**
     * @return BufferLogger
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-27
     */
    protected function getNewLogger()
    {
        return new BufferLogger();
    }
}
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

        $logger = $this->getNewBufferLogger();
        $logger->setEvent($event);
        $logger->setEventDispatcher($eventDispatcher);
        $logger->setLogRequestFactory($this->getNewLogRequestFactoryMock($request));
        $factory = $this->getNewLogRequestBufferFactoryMock($buffer);
        $factory->shouldReceive('create')
            ->andReturn($buffer)
            ->once();
        $logger->setLogRequestBufferFactory($factory);

        $logger->log($level, $message);
    }

    /**
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-27
     */
    public function testClean()
    {
        $request = $this->getNewLogRequestMock();
        $buffer = $this->getNewLogRequestRuntimeBufferMock($request);
        $requestFactory = $this->getNewLogRequestFactoryMock($request);
        $requestFactory->shouldReceive('create')
            ->never();
        $factory = $this->getNewLogRequestBufferFactoryMock($buffer);
        $event = $this->getNewEventMock();
        $event->shouldReceive('setLoggerCollection')
            ->once();
        $eventDispatcher = $this->getNewEventDispatcherMock();
        $eventDispatcher->shouldReceive('dispatch')
            ->with(BufferEvent::BUFFER_CLEAN, $event)
            ->once();

        $logger = $this->getNewBufferLogger();
        $logger->setEvent($event);
        $logger->setEventDispatcher($eventDispatcher);
        $logger->setLogRequestFactory($requestFactory);
        $logger->setLogRequestBufferFactory($factory);

        $logger->clean();
    }

    /**
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-27
     */
    public function testFlushWithNoLogRequest()
    {
        $request = $this->getNewLogRequestMock();
        $buffer = $this->getNewLogRequestRuntimeBufferMock($request);
        $event = $this->getNewEventMock();
        $event->shouldReceive('setLoggerCollection')
            ->once();
        $dispatcher = $this->getNewEventDispatcherMock();
        $dispatcher->shouldReceive('dispatch')
            ->with(BufferEvent::BUFFER_FLUSH, $event)
            ->once();
        $factory = $this->getNewLogRequestFactoryMock($request);
        $factory->shouldReceive('create')
            ->never();

        $logger = $this->getNewBufferLogger();
        $logger->setEvent($event);
        $logger->setEventDispatcher($dispatcher);
        $logger->setLogRequestFactory($factory);
        $logger->setLogRequestBufferFactory($this->getNewLogRequestBufferFactoryMock($buffer));

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
        $buffer = $this->getNewLogRequestRuntimeBufferMock($request);
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
            ->with(BufferEvent::BUFFER_FLUSH, $event)
            ->once();
        $factory = $this->getNewLogRequestFactoryMock($request);
        $realLogger = $this->getNewPsr3LoggerMock();

        $logger = $this->getNewBufferLogger();
        $logger->setEvent($event);
        $logger->setEventDispatcher($dispatcher);
        $logger->addLogger($realLogger);
        $logger->setLogRequestFactory($factory);
        $logger->setLogRequestBufferFactory($this->getNewLogRequestBufferFactoryMock($buffer));

        $logger->log($level, $message);
        $logger->flush();
    }

    /**
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-09-06
     */
    public function testSetLogRequestFactory()
    {
        $logger = $this->getNewBufferLogger();

        $factory = $this->getNewPlainLogRequestFactoryMock();
        $this->assertEquals($logger, $logger->setLogRequestFactory($factory));
    }

    /**
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-11-13
     */
    public function testSetEvent()
    {
        $logger = $this->getNewBufferLogger();
        $event = $this->getNewEventMock();

        $this->assertEquals($logger, $logger->setEvent($event));
    }

    /**
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-11-13
     */
    public function testSetEventDispatcher()
    {
        $logger = $this->getNewBufferLogger();
        $dispatcher = $this->getNewEventDispatcherMock();

        $this->assertEquals($logger, $logger->setEventDispatcher($dispatcher));
    }

    /**
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-09-06
     */
    public function testGetHasSetLogRequestBufferFactory()
    {
        $logger = $this->getNewBufferLogger();
        $this->assertNull($logger->getLogRequestBufferFactory());
        $this->assertFalse($logger->hasLogRequestBufferFactory());

        $request = $this->getNewLogRequestMock();
        $buffer = $this->getNewLogRequestRuntimeBufferMock($request);
        $factory = $this->getNewLogRequestBufferFactoryMock($buffer);
        $factory->shouldReceive('create')
            ->andReturn($buffer)
            ->once();
        $logger->setLogRequestBufferFactory($factory);

        $this->assertTrue($logger->hasLogRequestBufferFactory());
        $this->assertEquals($factory, $logger->getLogRequestBufferFactory());
    }

    /**
     * @return BufferLogger
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-27
     */
    protected function getNewBufferLogger()
    {
        return new BufferLogger();
    }
}
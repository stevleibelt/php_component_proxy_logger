<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-08-28 
 */

namespace Test\Net\Bazzline\Component\ProxyLogger\Factory;

use Net\Bazzline\Component\ProxyLogger\Factory\ManipulateBufferLoggerFactory;
use Test\Net\Bazzline\Component\ProxyLogger\TestCase;

/**
 * Class ManipulateBufferLoggerFactoryTest
 *
 * @package Test\Net\Bazzline\Component\ProxyLogger
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-08-28
 */
class ManipulateBufferLoggerFactoryTest extends TestCase
{
    /**
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-28
     */
    public function testCreateWithLogger()
    {
        $loggerFactory = new ManipulateBufferLoggerFactory();
        $realLogger = $this->getNewPsr3LoggerMock();
        $requestFactory = $this->getNewPlainLogRequestFactoryMock();
        $buffer = $this->getNewLogRequestRuntimeBufferMock();
        $bufferFactory = $this->getNewPlainLogRequestBufferFactoryMock();
        $bufferFactory->shouldReceive('create')
            ->andReturn($buffer)
            ->once();
        $loggerFactory->setLogRequestFactory($requestFactory);
        $loggerFactory->setLogRequestBufferFactory($bufferFactory);

        $logger = $loggerFactory->create($realLogger);
        $event = $logger->getEvent();

        $this->assertInstanceOf('Net\Bazzline\Component\ProxyLogger\Logger\BufferLoggerInterface', $logger);
        $this->assertInstanceOf('Net\Bazzline\Component\ProxyLogger\Logger\BufferLogger', $logger);
        $this->assertFalse($event->hasFlushBufferTrigger());
        $this->assertFalse($event->hasBypassBuffer());
    }

    /**
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-09-06
     */
    public function testCreateWithLoggerAndWithFlushBufferTriggerFactory()
    {
        $loggerFactory = new ManipulateBufferLoggerFactory();
        $realLogger = $this->getNewPsr3LoggerMock();
        $requestFactory = $this->getNewPlainLogRequestFactoryMock();
        $buffer = $this->getNewLogRequestRuntimeBufferMock();
        $bufferFactory = $this->getNewPlainLogRequestBufferFactoryMock();
        $bufferFactory->shouldReceive('create')
            ->andReturn($buffer)
            ->once();
        $trigger = $this->getNewAbstractFlushBufferTriggerMock();
        $triggerFactory = $this->getNewFlushBufferTriggerFactoryMock();
        $triggerFactory->shouldReceive('create')
            ->andReturn($trigger)
            ->once();
        $loggerFactory->setLogRequestFactory($requestFactory);
        $loggerFactory->setLogRequestBufferFactory($bufferFactory);
        $loggerFactory->setFlushBufferTriggerFactory($triggerFactory);

        $logger = $loggerFactory->create($realLogger);
        $event = $logger->getEvent();

        $this->assertInstanceOf('Net\Bazzline\Component\ProxyLogger\Logger\BufferLoggerInterface', $logger);
        $this->assertInstanceOf('Net\Bazzline\Component\ProxyLogger\Logger\BufferLogger', $logger);
        $this->assertTrue($event->hasFlushBufferTrigger());
        $this->assertFalse($event->hasBypassBuffer());
    }

    /**
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-09-06
     */
    public function testCreateWithLoggerAndWithAvoidBufferFactory()
    {
        $loggerFactory = new ManipulateBufferLoggerFactory();
        $realLogger = $this->getNewPsr3LoggerMock();
        $requestFactory = $this->getNewPlainLogRequestFactoryMock();
        $buffer = $this->getNewLogRequestRuntimeBufferMock();
        $bufferFactory = $this->getNewPlainLogRequestBufferFactoryMock();
        $bufferFactory->shouldReceive('create')
            ->andReturn($buffer)
            ->once();
        $bypass = $this->getNewBypassBufferMock();
        $bypassFactory = $this->getNewBypassBufferFactoryMock();
        $bypassFactory->shouldReceive('create')
            ->andReturn($bypass)
            ->once();
        $loggerFactory->setLogRequestFactory($requestFactory);
        $loggerFactory->setLogRequestBufferFactory($bufferFactory);
        $loggerFactory->setBypassBufferFactory($bypassFactory);

        $logger = $loggerFactory->create($realLogger);
        $event = $logger->getEvent();

        $this->assertInstanceOf('Net\Bazzline\Component\ProxyLogger\Logger\BufferLoggerInterface', $logger);
        $this->assertInstanceOf('Net\Bazzline\Component\ProxyLogger\Logger\BufferLogger', $logger);
        $this->assertFalse($event->hasFlushBufferTrigger());
        $this->assertTrue($event->hasBypassBuffer());
    }

    /**
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-09-06
     */
    public function testCreateWithLoggerAndWithFlushBufferTriggerFactoryAndWithAvoidBufferFactory()
    {
        $loggerFactory = new ManipulateBufferLoggerFactory();
        $realLogger = $this->getNewPsr3LoggerMock();
        $requestFactory = $this->getNewPlainLogRequestFactoryMock();
        $buffer = $this->getNewLogRequestRuntimeBufferMock();
        $bufferFactory = $this->getNewPlainLogRequestBufferFactoryMock();
        $bufferFactory->shouldReceive('create')
            ->andReturn($buffer)
            ->once();
        $trigger = $this->getNewAbstractFlushBufferTriggerMock();
        $triggerFactory = $this->getNewFlushBufferTriggerFactoryMock();
        $triggerFactory->shouldReceive('create')
            ->andReturn($trigger)
            ->once();
        $bypass = $this->getNewBypassBufferMock();
        $bypassFactory = $this->getNewBypassBufferFactoryMock();
        $bypassFactory->shouldReceive('create')
            ->andReturn($bypass)
            ->once();
        $loggerFactory->setLogRequestFactory($requestFactory);
        $loggerFactory->setLogRequestBufferFactory($bufferFactory);
        $loggerFactory->setFlushBufferTriggerFactory($triggerFactory);
        $loggerFactory->setBypassBufferFactory($bypassFactory);

        $logger = $loggerFactory->create($realLogger);
        $event = $logger->getEvent();

        $this->assertInstanceOf('Net\Bazzline\Component\ProxyLogger\Logger\BufferLoggerInterface', $logger);
        $this->assertInstanceOf('Net\Bazzline\Component\ProxyLogger\Logger\BufferLogger', $logger);
        $this->assertTrue($event->hasFlushBufferTrigger());
        $this->assertTrue($event->hasBypassBuffer());
    }
}
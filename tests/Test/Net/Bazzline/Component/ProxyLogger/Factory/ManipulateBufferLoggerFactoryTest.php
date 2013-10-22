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
        $factory = new ManipulateBufferLoggerFactory();
        $logger = $this->getNewPsr3LoggerMock();

        $manipulateBufferLogger = $factory->create($logger);

        $this->assertInstanceOf('Net\Bazzline\Component\ProxyLogger\Factory\LogRequestFactoryInterface', $manipulateBufferLogger->getLogRequestFactory());
        $this->assertInstanceOf('Net\Bazzline\Component\ProxyLogger\Factory\LogRequestBufferFactoryInterface', $manipulateBufferLogger->getLogRequestBufferFactory());
        $this->assertInstanceOf('Net\Bazzline\Component\ProxyLogger\Proxy\ManipulateBufferLoggerInterface', $manipulateBufferLogger);
        $this->assertInstanceOf('Net\Bazzline\Component\ProxyLogger\Proxy\ManipulateBufferLogger', $manipulateBufferLogger);
        $this->assertTrue($manipulateBufferLogger->hasLogRequestFactory());
        $this->assertTrue($manipulateBufferLogger->hasLogRequestBufferFactory());
        $this->assertFalse($manipulateBufferLogger->hasFlushBufferTrigger());
        $this->assertFalse($manipulateBufferLogger->hasBypassBuffer());
    }

    /**
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-28
     */
    public function testCreateWithLoggerAndWithLogRequestFactory()
    {
        $factory = new ManipulateBufferLoggerFactory();
        $logger = $this->getNewPsr3LoggerMock();
        $logRequestFactory = $this->getNewPlainLogRequestFactoryMock();
        $factory->setLogRequestFactory($logRequestFactory);

        $manipulateBufferLogger = $factory->create($logger);

        $this->assertInstanceOf('Net\Bazzline\Component\ProxyLogger\Proxy\ManipulateBufferLoggerInterface', $manipulateBufferLogger);
        $this->assertInstanceOf('Net\Bazzline\Component\ProxyLogger\Proxy\ManipulateBufferLogger', $manipulateBufferLogger);
        $this->assertTrue($manipulateBufferLogger->hasLogRequestFactory());
        $this->assertTrue($manipulateBufferLogger->hasLogRequestBufferFactory());
        $this->assertFalse($manipulateBufferLogger->hasFlushBufferTrigger());
        $this->assertFalse($manipulateBufferLogger->hasBypassBuffer());
    }

    /**
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-28
     */
    public function testCreateWithLoggerAndWithLogRequestFactoryAndWithLogRequestBufferFactory()
    {
        $factory = new ManipulateBufferLoggerFactory();
        $logger = $this->getNewPsr3LoggerMock();
        $logRequestFactory = $this->getNewPlainLogRequestFactoryMock();
        $logRequestBufferFactory = $this->getNewPlainLogRequestBufferFactoryMock();
        $logRequestBufferFactory->shouldReceive('create')
            ->once();
        $factory->setLogRequestFactory($logRequestFactory);
        $factory->setLogRequestBufferFactory($logRequestBufferFactory);

        $manipulateBufferLogger = $factory->create($logger);

        $this->assertInstanceOf('Net\Bazzline\Component\ProxyLogger\Proxy\ManipulateBufferLoggerInterface', $manipulateBufferLogger);
        $this->assertInstanceOf('Net\Bazzline\Component\ProxyLogger\Proxy\ManipulateBufferLogger', $manipulateBufferLogger);
        $this->assertTrue($manipulateBufferLogger->hasLogRequestFactory());
        $this->assertTrue($manipulateBufferLogger->hasLogRequestBufferFactory());
        $this->assertFalse($manipulateBufferLogger->hasFlushBufferTrigger());
        $this->assertFalse($manipulateBufferLogger->hasBypassBuffer());
    }

    /**
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-09-06
     */
    public function testCreateWithLoggerAndWithLogRequestFactoryAndWithLogRequestBufferFactoryAndWithFlushBufferTrigger()
    {
        $factory = new ManipulateBufferLoggerFactory();
        $logger = $this->getNewPsr3LoggerMock();
        $logRequestFactory = $this->getNewPlainLogRequestFactoryMock();
        $logRequestBufferFactory = $this->getNewPlainLogRequestBufferFactoryMock();
        $logRequestBufferFactory->shouldReceive('create')
            ->once();
        $flushBufferTrigger = $this->getNewAbstractFlushBufferTriggerMock();
        $flushBufferTriggerFactory = $this->getNewFlushBufferTriggerFactoryMock();
        $flushBufferTriggerFactory->shouldReceive('create')
            ->andReturn($flushBufferTrigger)
            ->once();
        $factory->setLogRequestFactory($logRequestFactory);
        $factory->setLogRequestBufferFactory($logRequestBufferFactory);
        $factory->setFlushBufferTriggerFactory($flushBufferTriggerFactory);

        $manipulateBufferLogger = $factory->create($logger);

        $this->assertInstanceOf('Net\Bazzline\Component\ProxyLogger\Proxy\ManipulateBufferLoggerInterface', $manipulateBufferLogger);
        $this->assertInstanceOf('Net\Bazzline\Component\ProxyLogger\Proxy\ManipulateBufferLogger', $manipulateBufferLogger);
        $this->assertTrue($manipulateBufferLogger->hasLogRequestFactory());
        $this->assertTrue($manipulateBufferLogger->hasLogRequestBufferFactory());
        $this->assertTrue($manipulateBufferLogger->hasFlushBufferTrigger());
        $this->assertFalse($manipulateBufferLogger->hasBypassBuffer());
    }

    /**
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-09-06
     */
    public function testCreateWithLoggerAndWithLogRequestFactoryAndWithLogRequestBufferFactoryAndWithAvoidBuffer()
    {
        $factory = new ManipulateBufferLoggerFactory();
        $logger = $this->getNewPsr3LoggerMock();
        $logRequestFactory = $this->getNewPlainLogRequestFactoryMock();
        $logRequestBufferFactory = $this->getNewPlainLogRequestBufferFactoryMock();
        $logRequestBufferFactory->shouldReceive('create')
            ->once();
        $bypassBuffer = $this->getNewBypassBufferMock();
        $bypassBufferFactory = $this->getNewBypassBufferFactoryMock();
        $bypassBufferFactory->shouldReceive('create')
            ->andReturn($bypassBuffer)
            ->once();
        $factory->setLogRequestFactory($logRequestFactory);
        $factory->setLogRequestBufferFactory($logRequestBufferFactory);
        $factory->setBypassBufferFactory($bypassBufferFactory);

        $manipulateBufferLogger = $factory->create($logger);

        $this->assertInstanceOf('Net\Bazzline\Component\ProxyLogger\Proxy\ManipulateBufferLoggerInterface', $manipulateBufferLogger);
        $this->assertInstanceOf('Net\Bazzline\Component\ProxyLogger\Proxy\ManipulateBufferLogger', $manipulateBufferLogger);
        $this->assertTrue($manipulateBufferLogger->hasLogRequestFactory());
        $this->assertTrue($manipulateBufferLogger->hasLogRequestBufferFactory());
        $this->assertFalse($manipulateBufferLogger->hasFlushBufferTrigger());
        $this->assertTrue($manipulateBufferLogger->hasBypassBuffer());
    }

    /**
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-09-06
     */
    public function testCreateWithLoggerAndWithLogRequestFactoryAndWithLogRequestBufferFactoryAndWithFlushBufferTriggerAndWithAvoidBuffer()
    {
        $factory = new ManipulateBufferLoggerFactory();
        $logger = $this->getNewPsr3LoggerMock();
        $logRequestFactory = $this->getNewPlainLogRequestFactoryMock();
        $logRequestBufferFactory = $this->getNewPlainLogRequestBufferFactoryMock();
        $logRequestBufferFactory->shouldReceive('create')
            ->once();
        $flushBufferTrigger = $this->getNewAbstractFlushBufferTriggerMock();
        $flushBufferTriggerFactory = $this->getNewFlushBufferTriggerFactoryMock();
        $flushBufferTriggerFactory->shouldReceive('create')
            ->andReturn($flushBufferTrigger)
            ->once();
        $bypassBuffer = $this->getNewBypassBufferMock();
        $bypassBufferFactory = $this->getNewBypassBufferFactoryMock();
        $bypassBufferFactory->shouldReceive('create')
            ->andReturn($bypassBuffer)
            ->once();
        $factory->setLogRequestFactory($logRequestFactory);
        $factory->setLogRequestBufferFactory($logRequestBufferFactory);
        $factory->setFlushBufferTriggerFactory($flushBufferTriggerFactory);
        $factory->setBypassBufferFactory($bypassBufferFactory);

        $manipulateBufferLogger = $factory->create($logger);

        $this->assertInstanceOf('Net\Bazzline\Component\ProxyLogger\Proxy\ManipulateBufferLoggerInterface', $manipulateBufferLogger);
        $this->assertInstanceOf('Net\Bazzline\Component\ProxyLogger\Proxy\ManipulateBufferLogger', $manipulateBufferLogger);
        $this->assertTrue($manipulateBufferLogger->hasLogRequestFactory());
        $this->assertTrue($manipulateBufferLogger->hasLogRequestBufferFactory());
        $this->assertTrue($manipulateBufferLogger->hasFlushBufferTrigger());
        $this->assertTrue($manipulateBufferLogger->hasBypassBuffer());
    }
}
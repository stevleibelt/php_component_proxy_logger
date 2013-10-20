<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-09-08 
 */

namespace Test\Net\Bazzline\Component\ProxyLogger\Factory;

use Net\Bazzline\Component\ProxyLogger\Factory\BufferLoggerFactory;
use Test\Net\Bazzline\Component\ProxyLogger\TestCase;

/**
 * Class BufferLoggerFactoryTest
 *
 * @package Test\Net\Bazzline\Component\ProxyLogger\Factory
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-09-08
 */
class BufferLoggerFactoryTest extends TestCase
{
    /**
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-09-10
     */
    public function testCreateWithLogger()
    {
        $factory = new BufferLoggerFactory();
        $logger = $this->getNewPsr3LoggerMock();

        $bufferLogger = $factory->create($logger);

        $this->assertInstanceOf('Net\Bazzline\Component\ProxyLogger\Proxy\BufferLoggerInterface', $bufferLogger);
        $this->assertInstanceOf('Net\Bazzline\Component\ProxyLogger\Proxy\BufferLogger', $bufferLogger);
        $this->assertTrue($bufferLogger->hasLogRequestFactory());
        $this->assertTrue($bufferLogger->hasLogRequestBufferFactory());
        $this->assertFalse($factory->hasLogRequestFactory());
        $this->assertFalse($factory->hasLogRequestBufferFactory());
    }

    /**
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-09-10
     */
    public function testCreateWithLoggerAndLogRequestFactory()
    {
        $factory = new BufferLoggerFactory();
        $logger = $this->getNewPsr3LoggerMock();
        $logRequestFactory = $this->getNewPlainLogRequestFactoryMock();
        $factory->setLogRequestFactory($logRequestFactory);

        $bufferLogger = $factory->create($logger);

        $this->assertInstanceOf('Net\Bazzline\Component\ProxyLogger\Proxy\BufferLoggerInterface', $bufferLogger);
        $this->assertInstanceOf('Net\Bazzline\Component\ProxyLogger\Proxy\BufferLogger', $bufferLogger);
        $this->assertTrue($bufferLogger->hasLogRequestFactory());
        $this->assertTrue($bufferLogger->hasLogRequestBufferFactory());
        $this->assertTrue($factory->hasLogRequestFactory());
        $this->assertFalse($factory->hasLogRequestBufferFactory());
    }

    /**
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-09-08
     */
    public function testCreateWithLoggerLogRequestBufferFactory()
    {
        $factory = new BufferLoggerFactory();
        $logger = $this->getNewPsr3LoggerMock();
        $logRequestBufferFactory = $this->getNewPlainLogRequestBufferFactoryMock();
        $logRequestBufferFactory->shouldReceive('create')
            ->once();
        $factory->setLogRequestBufferFactory($logRequestBufferFactory);

        $bufferLogger = $factory->create($logger);

        $this->assertInstanceOf('Net\Bazzline\Component\ProxyLogger\Proxy\BufferLoggerInterface', $bufferLogger);
        $this->assertInstanceOf('Net\Bazzline\Component\ProxyLogger\Proxy\BufferLogger', $bufferLogger);
        $this->assertTrue($bufferLogger->hasLogRequestFactory());
        $this->assertTrue($bufferLogger->hasLogRequestBufferFactory());
        $this->assertFalse($factory->hasLogRequestFactory());
        $this->assertTrue($factory->hasLogRequestBufferFactory());
    }

    /**
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-09-08
     */
    public function testCreateWithLoggerAndLogRequestFactoryAndLogRequestBufferFactory()
    {
        $factory = new BufferLoggerFactory();
        $logger = $this->getNewPsr3LoggerMock();
        $logRequestFactory = $this->getNewPlainLogRequestFactoryMock();
        $logRequestBufferFactory = $this->getNewPlainLogRequestBufferFactoryMock();
        $logRequestBufferFactory->shouldReceive('create')
            ->once();
        $factory->setLogRequestFactory($logRequestFactory);
        $factory->setLogRequestBufferFactory($logRequestBufferFactory);

        $bufferLogger = $factory->create($logger);

        $this->assertInstanceOf('Net\Bazzline\Component\ProxyLogger\Proxy\BufferLoggerInterface', $bufferLogger);
        $this->assertInstanceOf('Net\Bazzline\Component\ProxyLogger\Proxy\BufferLogger', $bufferLogger);
        $this->assertTrue($bufferLogger->hasLogRequestFactory());
        $this->assertTrue($bufferLogger->hasLogRequestBufferFactory());
        $this->assertTrue($factory->hasLogRequestFactory());
        $this->assertTrue($factory->hasLogRequestBufferFactory());
    }
}
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
     * @since 2013-09-08
     */
    public function testCreateWithLogger()
    {
        $factory = new BufferLoggerFactory();
        $realLogger = $this->getNewPsr3LoggerMock();
        $request = $this->getNewLogRequestMock();
        $requestFactory = $this->getNewPlainLogRequestFactoryMock();
        $buffer = $this->getNewLogRequestRuntimeBufferMock($request);
        $bufferFactory = $this->getNewPlainLogRequestBufferFactoryMock();
        $bufferFactory->shouldReceive('create')
            ->andReturn($buffer)
            ->once();
        $factory->setLogRequestFactory($requestFactory);
        $factory->setLogRequestBufferFactory($bufferFactory);

        $logger = $factory->create($realLogger);

        $this->assertInstanceOf('Net\Bazzline\Component\ProxyLogger\Logger\BufferLoggerInterface', $logger);
        $this->assertInstanceOf('Net\Bazzline\Component\ProxyLogger\Logger\BufferLogger', $logger);
        $this->assertInstanceOf('Net\Bazzline\Component\ProxyLogger\Event\BufferEvent', $logger->getEvent());
    }
}
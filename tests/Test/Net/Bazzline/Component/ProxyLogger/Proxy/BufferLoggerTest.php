<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 8/27/13
 */

namespace Test\Net\Bazzline\Component\ProxyLogger\Proxy;

use Net\Bazzline\Component\ProxyLogger\Proxy\BufferLogger;
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
        $request = $this->getLogRequest();
        $buffer = $this->getLogRequestRuntimeBuffer($request);

        $logger = $this->getNewBufferLogger();
        $logger->setLogRequestFactory($this->getLogRequestFactory($request));
        $bufferFactory = $this->getLogRequestBufferFactory($buffer);
        $bufferFactory->shouldReceive('create')
            ->andReturn($buffer)
            ->once();
        $logger->setLogRequestBufferFactory($bufferFactory);

        $logger->log($level, $message);
    }

    /**
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-27
     */
    public function testClean()
    {
        $request = $this->getLogRequest();
        $buffer = $this->getLogRequestRuntimeBuffer($request);
        $buffer->shouldReceive('attach')
            ->never();
        $requestFactory = $this->getLogRequestFactory($request);
        $requestFactory->shouldReceive('create')
            ->never();
        $bufferFactory = $this->getLogRequestBufferFactory($buffer);
        $bufferFactory->shouldReceive('create')
            ->twice();

        $logger = $this->getNewBufferLogger();
        $logger->setLogRequestFactory($requestFactory);
        $logger->setLogRequestBufferFactory($bufferFactory);

        $logger->clean();
    }

    /**
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-27
     */
    public function testFlushWithNoLogRequest()
    {
        $request = $this->getLogRequest();
        $buffer = $this->getLogRequestRuntimeBuffer($request);
        $buffer->shouldReceive('rewind')
            ->once();
        $buffer->shouldReceive('valid')
            ->andReturn(false)
            ->once();
        $buffer->shouldReceive('attach')
            ->never();
        $requestFactory = $this->getLogRequestFactory($request);
        $requestFactory->shouldReceive('create')
            ->never();

        $logger = $this->getNewBufferLogger();
        $logger->setLogRequestFactory($requestFactory);
        $logger->setLogRequestBufferFactory($this->getLogRequestBufferFactory($buffer));

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
        $request = $this->getLogRequest();
        $request->shouldReceive('getLevel')
            ->andReturn($level)
            ->once();
        $request->shouldReceive('getMessage')
            ->andReturn($message)
            ->once();
        $request->shouldReceive('getContext')
            ->andReturn(array())
            ->once();
        $buffer = $this->getLogRequestRuntimeBuffer($request);
        $buffer->shouldReceive('rewind')
            ->once();
        $buffer->shouldReceive('valid')
            ->andReturn(true, false)
            ->times(2);
        $buffer->shouldReceive('current')
            ->andReturn($request)
            ->once();
        $buffer->shouldReceive('next')
            ->once();
        $requestFactory = $this->getLogRequestFactory($request);
        $realLogger = $this->getPsr3Logger();
        $realLogger->shouldReceive('log')
            ->with($level, $message, array())
            ->once();

        $bufferLogger = $this->getNewBufferLogger();
        $bufferLogger->addLogger($realLogger);
        $bufferLogger->setLogRequestFactory($requestFactory);
        $bufferLogger->setLogRequestBufferFactory($this->getLogRequestBufferFactory($buffer));

        $bufferLogger->log($level, $message);
        $bufferLogger->flush();
    }

    /**
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-09-06
     */
    public function testGetHasSetLogRequestFactory()
    {
        $bufferLogger = $this->getNewBufferLogger();
        $this->assertNull($bufferLogger->getLogRequestFactory());
        $this->assertFalse($bufferLogger->hasLogRequestFactory());

        $logRequestFactory = $this->getPlainLogRequestFactory();
        $bufferLogger->setLogRequestFactory($logRequestFactory);

        $this->assertTrue($bufferLogger->hasLogRequestFactory());
        $this->assertEquals($logRequestFactory, $bufferLogger->getLogRequestFactory());
    }

    /**
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-09-06
     */
    public function testGetHasSetLogRequestBufferFactory()
    {
        $bufferLogger = $this->getNewBufferLogger();
        $this->assertNull($bufferLogger->getLogRequestBufferFactory());
        $this->assertFalse($bufferLogger->hasLogRequestBufferFactory());

        $logRequest = $this->getLogRequest();
        $logRequestBuffer = $this->getLogRequestRuntimeBuffer($logRequest);
        $logRequestBuffer->shouldReceive('attach')
            ->with($logRequest)
            ->never();
        $logRequestBufferFactory = $this->getLogRequestBufferFactory($logRequestBuffer);
        $logRequestBufferFactory->shouldReceive('create')
            ->andReturn($logRequestBuffer)
            ->once();
        $bufferLogger->setLogRequestBufferFactory($logRequestBufferFactory);

        $this->assertTrue($bufferLogger->hasLogRequestBufferFactory());
        $this->assertEquals($logRequestBufferFactory, $bufferLogger->getLogRequestBufferFactory());
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
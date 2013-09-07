<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-08-28 
 */

namespace Test\Net\Bazzline\Component\Logger\Proxy;

use Net\Bazzline\Component\Logger\BufferManipulation\UpwardFlushBufferTrigger;
use Net\Bazzline\Component\Logger\Proxy\ManipulateBufferLogger;
use Psr\Log\LogLevel;
use Test\Net\Bazzline\Component\Logger\TestCase;

/**
 * Class ManipulateBufferLoggerTest
 *
 * @package Test\Net\Bazzline\Component\Logger\Proxy
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-08-28
 */
class ManipulateBufferLoggerTest extends TestCase
{
    /**
     * @var \Mockery\MockInterface|\Net\Bazzline\Component\Logger\BufferManipulation\BypassBufferInterface
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-09-06
     */
    private $avoidBuffer;

    /**
     * @var \Net\Bazzline\Component\Logger\BufferManipulation\FlushBufferTriggerInterface
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-28
     */
    private $flushBufferTrigger;

    /**
     * @var string
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-28
     */
    private $message;

    /**
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-28
     */
    protected function setUp()
    {
        $this->avoidBuffer = $this->getBypassBuffer();
        $this->flushBufferTrigger = new UpwardFlushBufferTrigger();
        $this->message = 'the message is love';
    }

    /**
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-28
     */
    public function testLogWithoutReachingTrigger()
    {
        $logger = $this->getNewLogger();
        $logger->setFlushBufferTrigger($this->flushBufferTrigger);

        $request = $this->getLogRequest();

        $buffer = $this->getLogRequestRuntimeBuffer($request);

        $requestFactory = $this->getPlainLogRequestFactory();
        $requestFactory->shouldReceive('create')
            ->with(LogLevel::INFO, $this->message, array())
            ->andReturn($request)
            ->once();

        $bufferFactory = $this->getPlainLogRequestBufferFactory();
        $bufferFactory->shouldReceive('create')
            ->andReturn($buffer)
            ->once();

        $logger->setLogRequestFactory($requestFactory);
        $logger->setLogRequestBufferFactory($bufferFactory);

        $logger->getFlushBufferTrigger()
            ->setTriggerToAlert();

        $logger->info($this->message);
    }

    /**
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-28
     */
    public function testLogWithReachingTrigger()
    {
        $logger = $this->getNewLogger();
        $logger->setFlushBufferTrigger($this->flushBufferTrigger);

        $realLogger = $this->getPsr3Logger();
        $realLogger->shouldReceive('log')
            ->with(LogLevel::INFO, $this->message, array())
            ->once();
        $realLogger->shouldReceive('log')
            ->with(LogLevel::ALERT, $this->message, array())
            ->once();

        $logger->addLogger($realLogger);

        $infoRequest = $this->getLogRequest();
        $infoRequest->shouldReceive('getLevel')
            ->andReturn(LogLevel::INFO)
            ->once();
        $infoRequest->shouldReceive('getMessage')
            ->andReturn($this->message)
            ->once();
        $infoRequest->shouldReceive('getContext')
            ->andReturn(array())
            ->once();
        $alertRequest = $this->getLogRequest();
        $alertRequest->shouldReceive('getLevel')
            ->andReturn(LogLevel::ALERT)
            ->once();
        $alertRequest->shouldReceive('getMessage')
            ->andReturn($this->message)
            ->once();
        $alertRequest->shouldReceive('getContext')
            ->andReturn(array())
            ->once();

        $buffer = $this->getLogRequestRuntimeBuffer($infoRequest);
        $buffer->shouldReceive('attach')
            ->with($infoRequest)
            ->once();
        $buffer->shouldReceive('attach')
            ->with($alertRequest)
            ->once();
        $buffer->shouldReceive('rewind')
            ->once();
        $buffer->shouldReceive('valid')
            ->andReturn(true, true, false)
            ->times(3);
        $buffer->shouldReceive('current')
            ->andReturn($infoRequest, $alertRequest)
            ->twice();
        $buffer->shouldReceive('next')
            ->twice();

        $requestFactory = $this->getPlainLogRequestFactory();
        $requestFactory->shouldReceive('create')
            ->with(LogLevel::INFO, $this->message, array())
            ->andReturn($infoRequest)
            ->once();
        $requestFactory->shouldReceive('create')
            ->with(LogLevel::ALERT, $this->message, array())
            ->andReturn($alertRequest)
            ->once();

        $bufferFactory = $this->getPlainLogRequestBufferFactory();
        $bufferFactory->shouldReceive('create')
            ->andReturn($buffer)
            ->twice();

        $logger->setLogRequestFactory($requestFactory);
        $logger->setLogRequestBufferFactory($bufferFactory);

        $logger->getFlushBufferTrigger()
            ->setTriggerToAlert();

        $logger->info($this->message);
        $logger->alert($this->message);
    }

    /**
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-28
     */
    public function testLogWithReachingUpwardLogLevelMap()
    {
        $logger = $this->getNewLogger();
        $logger->setFlushBufferTrigger($this->flushBufferTrigger);

        $realLogger = $this->getPsr3Logger();
        $realLogger->shouldReceive('log')
            ->with(LogLevel::INFO, $this->message, array())
            ->once();
        $realLogger->shouldReceive('log')
            ->with(LogLevel::ERROR, $this->message, array())
            ->once();
        $logger->addLogger($realLogger);

        $infoRequest = $this->getLogRequest();
        $infoRequest->shouldReceive('getLevel')
            ->andReturn(LogLevel::INFO)
            ->once();
        $infoRequest->shouldReceive('getMessage')
            ->andReturn($this->message)
            ->once();
        $infoRequest->shouldReceive('getContext')
            ->andReturn(array())
            ->once();
        $errorRequest = $this->getLogRequest();
        $errorRequest->shouldReceive('getLevel')
            ->andReturn(LogLevel::ERROR)
            ->once();
        $errorRequest->shouldReceive('getMessage')
            ->andReturn($this->message)
            ->once();
        $errorRequest->shouldReceive('getContext')
            ->andReturn(array())
            ->once();

        $buffer = $this->getLogRequestRuntimeBuffer($infoRequest);
        $buffer->shouldReceive('attach')
            ->with($infoRequest)
            ->once();
        $buffer->shouldReceive('attach')
            ->with($errorRequest)
            ->once();
        $buffer->shouldReceive('rewind')
            ->once();
        $buffer->shouldReceive('valid')
            ->andReturn(true, true, false)
            ->times(3);
        $buffer->shouldReceive('current')
            ->andReturn($infoRequest, $errorRequest)
            ->twice();
        $buffer->shouldReceive('next')
            ->twice();

        $requestFactory = $this->getPlainLogRequestFactory();
        $requestFactory->shouldReceive('create')
            ->with(LogLevel::INFO, $this->message, array())
            ->andReturn($infoRequest)
            ->once();
        $requestFactory->shouldReceive('create')
            ->with(LogLevel::ERROR, $this->message, array())
            ->andReturn($errorRequest)
            ->once();

        $bufferFactory = $this->getPlainLogRequestBufferFactory();
        $bufferFactory->shouldReceive('create')
            ->andReturn($buffer)
            ->twice();

        $logger->setLogRequestFactory($requestFactory);
        $logger->setLogRequestBufferFactory($bufferFactory);

        $logger->getFlushBufferTrigger()
            ->setTriggerToWarning();

        $logger->info($this->message);
        $logger->error($this->message);
    }

    /**
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-28
     */
    public function testLogWithoutReachingUpwardLogLevelMap()
    {
        $logger = $this->getNewLogger();
        $logger->setFlushBufferTrigger($this->flushBufferTrigger);
        $realLogger = $this->getPsr3Logger();
        $realLogger->shouldReceive('log')
            ->with(LogLevel::INFO, $this->message, array())
            ->never();
        $realLogger->shouldReceive('log')
            ->with(LogLevel::ERROR, $this->message, array())
            ->never();
        $logger->addLogger($realLogger);

        $infoRequest = $this->getLogRequest();
        $infoRequest->shouldReceive('getLevel')
            ->never();
        $infoRequest->shouldReceive('getMessage')
            ->never();
        $infoRequest->shouldReceive('getContext')
            ->never();
        $errorRequest = $this->getLogRequest();
        $errorRequest->shouldReceive('getLevel')
            ->never();
        $errorRequest->shouldReceive('getMessage')
            ->never();
        $errorRequest->shouldReceive('getContext')
            ->never();

        $buffer = $this->getLogRequestRuntimeBuffer($infoRequest);
        $buffer->shouldReceive('attach')
            ->with($infoRequest)
            ->once();
        $buffer->shouldReceive('attach')
            ->with($errorRequest)
            ->once();
        $buffer->shouldReceive('rewind')
            ->never();
        $buffer->shouldReceive('valid')
            ->never();
        $buffer->shouldReceive('current')
            ->never();
        $buffer->shouldReceive('next')
            ->never();

        $requestFactory = $this->getPlainLogRequestFactory();
        $requestFactory->shouldReceive('create')
            ->with(LogLevel::INFO, $this->message, array())
            ->andReturn($infoRequest)
            ->once();
        $requestFactory->shouldReceive('create')
            ->with(LogLevel::ERROR, $this->message, array())
            ->andReturn($errorRequest)
            ->once();

        $bufferFactory = $this->getPlainLogRequestBufferFactory();
        $bufferFactory->shouldReceive('create')
            ->andReturn($buffer)
            ->once();

        $logger->setLogRequestFactory($requestFactory);
        $logger->setLogRequestBufferFactory($bufferFactory);

        $logger->getFlushBufferTrigger()
            ->setTriggerToAlert();

        $logger->info($this->message);
        $logger->error($this->message);
    }

    /**
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-09-06
     */
    public function testLogWithAvoidBuffering()
    {
        $logger = $this->getNewLogger();
        $this->avoidBuffer
            ->shouldReceive('bypassBuffer')
            ->with(LogLevel::INFO)
            ->andReturn(true)
            ->once();
        $this->avoidBuffer
            ->shouldReceive('bypassBuffer')
            ->with(LogLevel::ERROR)
            ->andReturn(false)
            ->once();

        $logger->setBypassBuffer($this->avoidBuffer);
        $realLogger = $this->getPsr3Logger();
        $realLogger->shouldReceive('log')
            ->with(LogLevel::INFO, $this->message, array())
            ->once();
        $realLogger->shouldReceive('log')
            ->with(LogLevel::ERROR, $this->message, array())
            ->never();
        $logger->addLogger($realLogger);

        $errorRequest = $this->getLogRequest();
        $errorRequest->shouldReceive('getLevel')
            ->never();
        $errorRequest->shouldReceive('getMessage')
            ->never();
        $errorRequest->shouldReceive('getContext')
            ->never();

        $buffer = $this->getLogRequestRuntimeBuffer($errorRequest);
        $buffer->shouldReceive('attach')
            ->with($errorRequest)
            ->once();
        $buffer->shouldReceive('rewind')
            ->never();
        $buffer->shouldReceive('valid')
            ->never();
        $buffer->shouldReceive('current')
            ->never();
        $buffer->shouldReceive('next')
            ->never();

        $requestFactory = $this->getPlainLogRequestFactory();
        $requestFactory->shouldReceive('create')
            ->with(LogLevel::ERROR, $this->message, array())
            ->andReturn($errorRequest)
            ->once();

        $bufferFactory = $this->getPlainLogRequestBufferFactory();
        $bufferFactory->shouldReceive('create')
            ->andReturn($buffer)
            ->once();

        $logger->setLogRequestFactory($requestFactory);
        $logger->setLogRequestBufferFactory($bufferFactory);

        $logger->info($this->message);
        $logger->error($this->message);
    }

    /**
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-09-06
     */
    public function testLogWithoutAvoidBuffering()
    {
        $logger = $this->getNewLogger();
        $this->avoidBuffer
            ->shouldReceive('bypassBuffer')
            ->with(LogLevel::INFO)
            ->andReturn(false)
            ->once();
        $this->avoidBuffer
            ->shouldReceive('bypassBuffer')
            ->with(LogLevel::ERROR)
            ->andReturn(false)
            ->once();

        $logger->setBypassBuffer($this->avoidBuffer);
        $realLogger = $this->getPsr3Logger();
        $realLogger->shouldReceive('log')
            ->with(LogLevel::INFO, $this->message, array())
            ->never();
        $realLogger->shouldReceive('log')
            ->with(LogLevel::ERROR, $this->message, array())
            ->never();
        $logger->addLogger($realLogger);

        $infoRequest = $this->getLogRequest();
        $infoRequest->shouldReceive('getLevel')
            ->never();
        $infoRequest->shouldReceive('getMessage')
            ->never();
        $infoRequest->shouldReceive('getContext')
            ->never();
        $errorRequest = $this->getLogRequest();
        $errorRequest->shouldReceive('getLevel')
            ->never();
        $errorRequest->shouldReceive('getMessage')
            ->never();
        $errorRequest->shouldReceive('getContext')
            ->never();

        $buffer = $this->getLogRequestRuntimeBuffer($infoRequest);
        $buffer->shouldReceive('attach')
            ->with($infoRequest)
            ->once();
        $buffer->shouldReceive('attach')
            ->with($errorRequest)
            ->once();
        $buffer->shouldReceive('rewind')
            ->never();
        $buffer->shouldReceive('valid')
            ->never();
        $buffer->shouldReceive('current')
            ->never();
        $buffer->shouldReceive('next')
            ->never();

        $requestFactory = $this->getPlainLogRequestFactory();
        $requestFactory->shouldReceive('create')
            ->with(LogLevel::INFO, $this->message, array())
            ->andReturn($infoRequest)
            ->once();
        $requestFactory->shouldReceive('create')
            ->with(LogLevel::ERROR, $this->message, array())
            ->andReturn($errorRequest)
            ->once();

        $bufferFactory = $this->getPlainLogRequestBufferFactory();
        $bufferFactory->shouldReceive('create')
            ->andReturn($buffer)
            ->once();

        $logger->setLogRequestFactory($requestFactory);
        $logger->setLogRequestBufferFactory($bufferFactory);

        $logger->info($this->message);
        $logger->error($this->message);
    }

    /**
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-09-06
     */
    public function testLogWithTriggerFlushBufferAndWithAvoidBuffering()
    {
        $logger = $this->getNewLogger();

        $this->avoidBuffer
            ->shouldReceive('bypassBuffer')
            ->with(LogLevel::INFO)
            ->andReturn(true)
            ->once();
        $this->avoidBuffer
            ->shouldReceive('bypassBuffer')
            ->with(LogLevel::ERROR)
            ->andReturn(false)
            ->once();
        $this->avoidBuffer
            ->shouldReceive('bypassBuffer')
            ->with(LogLevel::ALERT)
            ->andReturn(false)
            ->once();

        $logger->setFlushBufferTrigger($this->flushBufferTrigger);
        $logger->setBypassBuffer($this->avoidBuffer);

        $realLogger = $this->getPsr3Logger();
        $realLogger->shouldReceive('log')
            ->with(LogLevel::INFO, $this->message, array())
            ->once();
        $realLogger->shouldReceive('log')
            ->with(LogLevel::ALERT, $this->message, array())
            ->once();
        $realLogger->shouldReceive('log')
            ->with(LogLevel::ERROR, $this->message, array())
            ->never();
        $logger->addLogger($realLogger);

        $alertRequest = $this->getLogRequest();
        $alertRequest->shouldReceive('getLevel')
            ->andReturn(LogLevel::ALERT)
            ->once();
        $alertRequest->shouldReceive('getMessage')
            ->andReturn($this->message)
            ->once();
        $alertRequest->shouldReceive('getContext')
            ->andReturn(array())
            ->once();
        $errorRequest = $this->getLogRequest();
        $errorRequest->shouldReceive('getLevel')
            ->never();
        $errorRequest->shouldReceive('getMessage')
            ->never();
        $errorRequest->shouldReceive('getContext')
            ->never();

        $buffer = $this->getLogRequestRuntimeBuffer($errorRequest);
        $buffer->shouldReceive('attach')
            ->with($errorRequest)
            ->once();
        $buffer->shouldReceive('attach')
            ->with($alertRequest)
            ->once();
        $buffer->shouldReceive('rewind')
            ->once();
        $buffer->shouldReceive('valid')
            ->andReturn(true, false)
            ->twice();
        $buffer->shouldReceive('current')
            ->andReturn($alertRequest)
            ->once();
        $buffer->shouldReceive('next')
            ->once();

        $requestFactory = $this->getPlainLogRequestFactory();
        $requestFactory->shouldReceive('create')
            ->with(LogLevel::ERROR, $this->message, array())
            ->andReturn($errorRequest)
            ->once();
        $requestFactory->shouldReceive('create')
            ->with(LogLevel::ALERT, $this->message, array())
            ->andReturn($alertRequest)
            ->once();

        $bufferFactory = $this->getPlainLogRequestBufferFactory();
        $bufferFactory->shouldReceive('create')
            ->andReturn($buffer)
            ->twice();

        $logger->setLogRequestFactory($requestFactory);
        $logger->setLogRequestBufferFactory($bufferFactory);

        $logger->getFlushBufferTrigger()
            ->setTriggerToCritical();

        $logger->info($this->message);
        $logger->alert($this->message);
        $logger->error($this->message);
    }

    /**
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-28
     */
    public function testSetTriggerToLogLevelEmergency()
    {
        $logger = $this->getNewLogger();
        $logger->getFlushBufferTrigger()
            ->setTriggerToEmergency();

        $this->assertEquals(LogLevel::EMERGENCY, $logger->getFlushBufferTrigger()->getTrigger());
    }

    /**
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-28
     */
    public function testSetTriggerToLogLevelAlert()
    {
        $logger = $this->getNewLogger();
        $logger->getFlushBufferTrigger()
            ->setTriggerToAlert();

        $this->assertEquals(LogLevel::ALERT, $logger->getFlushBufferTrigger()->getTrigger());
    }

    /**
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-28
     */
    public function testSetTriggerToLogLevelCritical()
    {
        $logger = $this->getNewLogger();
        $logger->getFlushBufferTrigger()
            ->setTriggerToCritical();

        $this->assertEquals(LogLevel::CRITICAL, $logger->getFlushBufferTrigger()->getTrigger());
    }

    /**
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-28
     */
    public function testSetTriggerToLogLevelError()
    {
        $logger = $this->getNewLogger();
        $logger->getFlushBufferTrigger()
            ->setTriggerToError();

        $this->assertEquals(LogLevel::ERROR, $logger->getFlushBufferTrigger()->getTrigger());
    }

    /**
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-28
     */
    public function testSetTriggerToLogLevelWarning()
    {
        $logger = $this->getNewLogger();
        $logger->getFlushBufferTrigger()
            ->setTriggerToWarning();

        $this->assertEquals(LogLevel::WARNING, $logger->getFlushBufferTrigger()->getTrigger());
    }

    /**
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-28
     */
    public function testSetTriggerToLogLevelNotice()
    {
        $logger = $this->getNewLogger();
        $logger->getFlushBufferTrigger()
            ->setTriggerToNotice();

        $this->assertEquals(LogLevel::NOTICE, $logger->getFlushBufferTrigger()->getTrigger());
    }

    /**
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-28
     */
    public function testSetTriggerToLogLevelInfo()
    {
        $logger = $this->getNewLogger();

        $logger->getFlushBufferTrigger()
            ->setTriggerToInfo();
        $this->assertEquals(LogLevel::INFO, $logger->getFlushBufferTrigger()->getTrigger());
    }

    /**
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-28
     */
    public function testSetTriggerToLogLevelDebug()
    {
        $logger = $this->getNewLogger();
        $logger->getFlushBufferTrigger()
            ->setTriggerToDebug();

        $this->assertEquals(LogLevel::DEBUG, $logger->getFlushBufferTrigger()->getTrigger());
    }

    /**
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-28
     */
    public function testSetLogRequestFactory()
    {
        $factory = $this->getLogRequestFactory($this->getLogRequest());
        $factory->shouldReceive('create')
            ->never();
        $logger = $this->getNewLogger();

        $this->assertEquals($logger, $logger->setLogRequestFactory($factory));
    }

    /**
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-28
     */
    public function testSetTriggerToLogLevel()
    {
        $logger = $this->getNewLogger();
        $logger->getFlushBufferTrigger()
            ->setTriggerTo(LogLevel::CRITICAL);

        $this->assertEquals(LogLevel::CRITICAL, $logger->getFlushBufferTrigger()->getTrigger());
    }

    /**
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-28
     */
    public function testSetFlushBufferTrigger()
    {
        $logger = $this->getNewLogger();

        $this->assertEquals($logger, $logger->setFlushBufferTrigger($this->flushBufferTrigger));
    }

    /**
     * @return ManipulateBufferLogger
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-28
     */
    private function getNewLogger()
    {
        $logger = new ManipulateBufferLogger();
        $logger->setFlushBufferTrigger($this->flushBufferTrigger);

        return $logger;
    }
}
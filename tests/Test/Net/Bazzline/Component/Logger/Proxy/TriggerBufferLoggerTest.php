<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-08-28 
 */

namespace Test\Net\Bazzline\Component\Logger\Proxy;

use Net\Bazzline\Component\Logger\BufferManipulation\AlwaysFlushBufferTrigger;
use Net\Bazzline\Component\Logger\BufferManipulation\UpwardFlushBufferTrigger;
use Net\Bazzline\Component\Logger\Proxy\TriggerBufferLogger;
use Psr\Log\LogLevel;
use Test\Net\Bazzline\Component\Logger\TestCase;

/**
 * Class TriggerBufferLoggerTest
 *
 * @package Test\Net\Bazzline\Component\Logger\Proxy
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-08-28
 */
class TriggerBufferLoggerTest extends TestCase
{
    /**
     * @var string
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-28
     */
    private $message;

    /**
     * @var \Net\Bazzline\Component\Logger\BufferManipulation\FlushBufferTriggerInterface
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-28
     */
    private $flushBufferTrigger;

    /**
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-28
     * @todo extend - avoid buffer?
     */
    protected function setUp()
    {
        $this->message = 'the message is love';
        $this->flushBufferTrigger = new UpwardFlushBufferTrigger();
    }

    /**
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-28
     */
    public function testLogWithoutReachingTrigger()
    {
        $logger = $this->getNewLogger();
        $logger->setFlushBufferTrigger($this->flushBufferTrigger);
        $entry = $this->getLogEntry();
        $buffer = $this->getLogEntryRuntimeBuffer($entry);
        $entryFactory = $this->getPlainLogEntryFactory();
        $entryFactory->shouldReceive('create')
            ->with(LogLevel::INFO, $this->message, array())
            ->andReturn($entry)
            ->once();
        $bufferFactory = $this->getPlainLogEntryBufferFactory();
        $bufferFactory->shouldReceive('create')
            ->andReturn($buffer)
            ->once();
        $logger->injectLogEntryFactory($entryFactory);
        $logger->injectLogEntryBufferFactory($bufferFactory);

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
        $infoEntry = $this->getLogEntry();
        $infoEntry->shouldReceive('getLevel')
            ->andReturn(LogLevel::INFO)
            ->once();
        $infoEntry->shouldReceive('getMessage')
            ->andReturn($this->message)
            ->once();
        $infoEntry->shouldReceive('getContext')
            ->andReturn(array())
            ->once();
        $alertEntry = $this->getLogEntry();
        $alertEntry->shouldReceive('getLevel')
            ->andReturn(LogLevel::ALERT)
            ->once();
        $alertEntry->shouldReceive('getMessage')
            ->andReturn($this->message)
            ->once();
        $alertEntry->shouldReceive('getContext')
            ->andReturn(array())
            ->once();
        $buffer = $this->getLogEntryRuntimeBuffer($infoEntry);
        $buffer->shouldReceive('attach')
            ->with($infoEntry)
            ->once();
        $buffer->shouldReceive('attach')
            ->with($alertEntry)
            ->once();
        $buffer->shouldReceive('rewind')
            ->once();
        $buffer->shouldReceive('valid')
            ->andReturn(true, true, false)
            ->times(3);
        $buffer->shouldReceive('current')
            ->andReturn($infoEntry, $alertEntry)
            ->twice();
        $buffer->shouldReceive('next')
            ->twice();
        $entryFactory = $this->getPlainLogEntryFactory();
        $entryFactory->shouldReceive('create')
            ->with(LogLevel::INFO, $this->message, array())
            ->andReturn($infoEntry)
            ->once();
        $entryFactory->shouldReceive('create')
            ->with(LogLevel::ALERT, $this->message, array())
            ->andReturn($alertEntry)
            ->once();
        $bufferFactory = $this->getPlainLogEntryBufferFactory();
        $bufferFactory->shouldReceive('create')
            ->andReturn($buffer)
            ->twice();
        $logger->injectLogEntryFactory($entryFactory);
        $logger->injectLogEntryBufferFactory($bufferFactory);

        $logger->getFlushBufferTrigger()
            ->setTriggerToAlert();
        $logger->info($this->message);
        $logger->alert($this->message);
    }

    /**
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-28
     */
    public function testLogWithReachingInheritanceMapTrigger()
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
        $infoEntry = $this->getLogEntry();
        $infoEntry->shouldReceive('getLevel')
            ->andReturn(LogLevel::INFO)
            ->once();
        $infoEntry->shouldReceive('getMessage')
            ->andReturn($this->message)
            ->once();
        $infoEntry->shouldReceive('getContext')
            ->andReturn(array())
            ->once();
        $errorEntry = $this->getLogEntry();
        $errorEntry->shouldReceive('getLevel')
            ->andReturn(LogLevel::ERROR)
            ->once();
        $errorEntry->shouldReceive('getMessage')
            ->andReturn($this->message)
            ->once();
        $errorEntry->shouldReceive('getContext')
            ->andReturn(array())
            ->once();
        $buffer = $this->getLogEntryRuntimeBuffer($infoEntry);
        $buffer->shouldReceive('attach')
            ->with($infoEntry)
            ->once();
        $buffer->shouldReceive('attach')
            ->with($errorEntry)
            ->once();
        $buffer->shouldReceive('rewind')
            ->once();
        $buffer->shouldReceive('valid')
            ->andReturn(true, true, false)
            ->times(3);
        $buffer->shouldReceive('current')
            ->andReturn($infoEntry, $errorEntry)
            ->twice();
        $buffer->shouldReceive('next')
            ->twice();
        $entryFactory = $this->getPlainLogEntryFactory();
        $entryFactory->shouldReceive('create')
            ->with(LogLevel::INFO, $this->message, array())
            ->andReturn($infoEntry)
            ->once();
        $entryFactory->shouldReceive('create')
            ->with(LogLevel::ERROR, $this->message, array())
            ->andReturn($errorEntry)
            ->once();
        $bufferFactory = $this->getPlainLogEntryBufferFactory();
        $bufferFactory->shouldReceive('create')
            ->andReturn($buffer)
            ->twice();
        $logger->injectLogEntryFactory($entryFactory);
        $logger->injectLogEntryBufferFactory($bufferFactory);

        $logger->getFlushBufferTrigger()
            ->setTriggerToWarning();
        $logger->info($this->message);
        $logger->error($this->message);
    }

    /**
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-28
     */
    public function testLogWithNoReachingInheritanceMapTrigger()
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
        $infoEntry = $this->getLogEntry();
        $infoEntry->shouldReceive('getLevel')
            ->never();
        $infoEntry->shouldReceive('getMessage')
            ->never();
        $infoEntry->shouldReceive('getContext')
            ->never();
        $errorEntry = $this->getLogEntry();
        $errorEntry->shouldReceive('getLevel')
            ->never();
        $errorEntry->shouldReceive('getMessage')
            ->never();
        $errorEntry->shouldReceive('getContext')
            ->never();
        $buffer = $this->getLogEntryRuntimeBuffer($infoEntry);
        $buffer->shouldReceive('attach')
            ->with($infoEntry)
            ->once();
        $buffer->shouldReceive('attach')
            ->with($errorEntry)
            ->once();
        $buffer->shouldReceive('rewind')
            ->never();
        $buffer->shouldReceive('valid')
            ->never();
        $buffer->shouldReceive('current')
            ->never();
        $buffer->shouldReceive('next')
            ->never();
        $entryFactory = $this->getPlainLogEntryFactory();
        $entryFactory->shouldReceive('create')
            ->with(LogLevel::INFO, $this->message, array())
            ->andReturn($infoEntry)
            ->once();
        $entryFactory->shouldReceive('create')
            ->with(LogLevel::ERROR, $this->message, array())
            ->andReturn($errorEntry)
            ->once();
        $bufferFactory = $this->getPlainLogEntryBufferFactory();
        $bufferFactory->shouldReceive('create')
            ->andReturn($buffer)
            ->once();
        $logger->injectLogEntryFactory($entryFactory);
        $logger->injectLogEntryBufferFactory($bufferFactory);

        $logger->getFlushBufferTrigger()
            ->setTriggerToAlert();
        $logger->info($this->message);
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
    public function testInjectLogEntryFactory()
    {
        $factory = $this->getLogEntryFactory($this->getLogEntry());
        $factory->shouldReceive('create')
            ->never();
        $logger = $this->getNewLogger();

        $this->assertEquals($logger, $logger->injectLogEntryFactory($factory));
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
    public function testSetTriggeredLogLevelInheritanceMap()
    {
        $logger = $this->getNewLogger();

        $this->assertEquals($logger, $logger->setFlushBufferTrigger($this->flushBufferTrigger));
    }

    /**
     * @return TriggerBufferLogger
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-28
     */
    private function getNewLogger()
    {
        $logger = new TriggerBufferLogger();
        $logger->setFlushBufferTrigger($this->flushBufferTrigger);

        return $logger;
    }
}
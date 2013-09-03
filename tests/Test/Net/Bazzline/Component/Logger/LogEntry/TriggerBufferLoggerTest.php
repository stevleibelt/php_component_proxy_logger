<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-08-28 
 */

namespace Test\Net\Bazzline\Component\Logger\Proxy;

use Net\Bazzline\Component\Logger\Configuration\EmptyLogLevelGateKeeper;
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
     * @var array
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-28
     */
    private $logLevelThreshold;

    /**
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-28
     */
    protected function setUp()
    {
        $this->message = 'the message is love';
        $this->logLevelThreshold = new EmptyLogLevelGateKeeper(
            array(
                LogLevel::ALERT => array(
                    LogLevel::ERROR,
                    LogLevel::CRITICAL,
                    LogLevel::EMERGENCY
                )
            )
        );
    }

    /**
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-28
     */
    public function testLogWithoutReachingTrigger()
    {
        $logger = $this->getNewLogger();
        $logger->setLogLevelThreshold($this->logLevelThreshold);
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

        $logger->setLogLevelTriggerToAlert();
        $logger->info($this->message);
    }

    /**
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-28
     */
    public function testLogWithReachingTrigger()
    {
        $logger = $this->getNewLogger();
        $logger->setLogLevelThreshold($this->logLevelThreshold);
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

        $logger->setLogLevelTriggerToAlert();
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
        $logger->setLogLevelThreshold($this->logLevelThreshold);
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

        $logger->setLogLevelTriggerToAlert();
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
        $logLevelThreshold = new EmptyLogLevelGateKeeper(
            array(
                LogLevel::ALERT => array(
                    LogLevel::CRITICAL,
                    LogLevel::EMERGENCY
                )
            )
        );
        $logger->setLogLevelThreshold($logLevelThreshold);
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

        $logger->setLogLevelTriggerToAlert();
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
        $logger->setLogLevelTriggerToEmergency();

        $this->assertEquals(LogLevel::EMERGENCY, $logger->getLogLevelTrigger());
    }

    /**
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-28
     */
    public function testSetTriggerToLogLevelAlert()
    {
        $logger = $this->getNewLogger();
        $logger->setLogLevelTriggerToAlert();

        $this->assertEquals(LogLevel::ALERT, $logger->getLogLevelTrigger());
    }

    /**
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-28
     */
    public function testSetTriggerToLogLevelCritical()
    {
        $logger = $this->getNewLogger();
        $logger->setLogLevelTriggerToCritical();

        $this->assertEquals(LogLevel::CRITICAL, $logger->getLogLevelTrigger());
    }

    /**
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-28
     */
    public function testSetTriggerToLogLevelError()
    {
        $logger = $this->getNewLogger();
        $logger->setLogLevelTriggerToError();

        $this->assertEquals(LogLevel::ERROR, $logger->getLogLevelTrigger());
    }

    /**
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-28
     */
    public function testSetTriggerToLogLevelWarning()
    {
        $logger = $this->getNewLogger();
        $logger->setLogLevelTriggerToWarning();

        $this->assertEquals(LogLevel::WARNING, $logger->getLogLevelTrigger());
    }

    /**
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-28
     */
    public function testSetTriggerToLogLevelNotice()
    {
        $logger = $this->getNewLogger();
        $logger->setLogLevelTriggerToNotice();

        $this->assertEquals(LogLevel::NOTICE, $logger->getLogLevelTrigger());
    }

    /**
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-28
     */
    public function testSetTriggerToLogLevelInfo()
    {
        $logger = $this->getNewLogger();
        $logger->setLogLevelTriggerToInfo();

        $this->assertEquals(LogLevel::INFO, $logger->getLogLevelTrigger());
    }

    /**
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-28
     */
    public function testSetTriggerToLogLevelDebug()
    {
        $logger = $this->getNewLogger();
        $logger->setLogLevelTriggerToDebug();

        $this->assertEquals(LogLevel::DEBUG, $logger->getLogLevelTrigger());
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
        $logger->setLogLevelTrigger(LogLevel::CRITICAL);

        $this->assertEquals(LogLevel::CRITICAL, $logger->getLogLevelTrigger());
    }

    /**
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-28
     */
    public function testSetTriggeredLogLevelInheritanceMap()
    {
        $logger = $this->getNewLogger();

        $this->assertEquals($logger, $logger->setLogLevelThreshold($this->logLevelThreshold));
    }

    /**
     * @return TriggerBufferLogger
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-28
     */
    private function getNewLogger()
    {
        return new TriggerBufferLogger();
    }
}
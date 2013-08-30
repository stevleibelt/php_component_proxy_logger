<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 8/27/13
 */

namespace Test\Net\Bazzline\Component\Logger;

use Net\Bazzline\Component\Logger\Proxy\BufferLogger;
use Mockery;
use Psr\Log\LogLevel;
use Test\Net\Bazzline\Component\Logger\TestCase;

/**
 * Class BufferLoggerTest
 *
 * @package Test\Net\Bazzline\Component\Logger
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
        $entry = $this->getLogEntry();
        $buffer = $this->getLogEntryRuntimeBuffer($entry);

        $logger = $this->getNewBufferedLogger();
        $logger->injectLogEntryFactory($this->getLogEntryFactory($entry));
        $bufferFactory = $this->getLogEntryBufferFactory($buffer);
        $bufferFactory->shouldReceive('create')
            ->andReturn($buffer)
            ->once();
        $logger->injectLogEntryBufferFactory($bufferFactory);

        $logger->log($level, $message);
    }

    /**
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-27
     */
    public function testClean()
    {
        $entry = $this->getLogEntry();
        $buffer = $this->getLogEntryRuntimeBuffer($entry);
        $buffer->shouldReceive('attach')
            ->never();
        $entryFactory = $this->getLogEntryFactory($entry);
        $entryFactory->shouldReceive('create')
            ->never();
        $bufferFactory = $this->getLogEntryBufferFactory($buffer);
        $bufferFactory->shouldReceive('create')
            ->twice();

        $logger = $this->getNewBufferedLogger();
        $logger->injectLogEntryFactory($entryFactory);
        $logger->injectLogEntryBufferFactory($bufferFactory);

        $logger->clean();
    }

    /**
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-27
     */
    public function testFlushWithNoEntry()
    {
        $entry = $this->getLogEntry();
        $buffer = $this->getLogEntryRuntimeBuffer($entry);
        $buffer->shouldReceive('rewind')
            ->once();
        $buffer->shouldReceive('valid')
            ->andReturn(false)
            ->once();
        $buffer->shouldReceive('attach')
            ->never();
        $entryFactory = $this->getLogEntryFactory($entry);
        $entryFactory->shouldReceive('create')
            ->never();

        $logger = $this->getNewBufferedLogger();
        $logger->injectLogEntryFactory($entryFactory);
        $logger->injectLogEntryBufferFactory($this->getLogEntryBufferFactory($buffer));

        $logger->flush();
    }

    /**
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-27
     */
    public function testFlushWithEntry()
    {
        $level = LogLevel::WARNING;
        $message = 'the message is love';
        $entry = $this->getLogEntry();
        $entry->shouldReceive('getLevel')
            ->andReturn($level)
            ->once();
        $entry->shouldReceive('getMessage')
            ->andReturn($message)
            ->once();
        $entry->shouldReceive('getContext')
            ->andReturn(array())
            ->once();
        $buffer = $this->getLogEntryRuntimeBuffer($entry);
        $buffer->shouldReceive('rewind')
            ->once();
        $buffer->shouldReceive('valid')
            ->andReturn(true, false)
            ->times(2);
        $buffer->shouldReceive('current')
            ->andReturn($entry)
            ->once();
        $buffer->shouldReceive('next')
            ->once();
        $entryFactory = $this->getLogEntryFactory($entry);
        $realLogger = $this->getPsr3Logger();
        $realLogger->shouldReceive('log')
            ->with($level, $message, array())
            ->once();

        $logger = $this->getNewBufferedLogger();
        $logger->addLogger($realLogger);
        $logger->injectLogEntryFactory($entryFactory);
        $logger->injectLogEntryBufferFactory($this->getLogEntryBufferFactory($buffer));

        $logger->log($level, $message);
        $logger->flush();
    }

    /**
     * @return BufferLogger
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-27
     */
    protected function getNewBufferedLogger()
    {
        return new BufferLogger();
    }
}
<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-08-26
 */

namespace Test\Net\Bazzline\Component\Logger;

use Net\Bazzline\Component\Logger\LogEntry\LogEntryBufferInterface;
use Net\Bazzline\Component\Logger\LogEntry\LogEntryInterface;
use Net\Bazzline\Component\Logger\LogEntry\LogEntryRuntimeBuffer;
use Mockery;
use PHPUnit_Framework_TestCase;

/**
 * Class TestCase
 *
 * @package Test\Net\Bazzline\Component\Logger
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-08-26
 */
class TestCase extends PHPUnit_Framework_TestCase
{
    /**
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-26
     */
    protected function tearDown()
    {
        Mockery::close();
    }

    /**
     * @return Mockery\MockInterface|\Psr\Log\NullLogger
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-27
     */
    protected function getPsr3Logger()
    {
        $mock = Mockery::mock('Psr\Log\NullLogger');

        return $mock;
    }

    /**
     * @return Mockery\MockInterface|\Net\Bazzline\Component\Logger\LogEntry\LogEntry
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-27
     */
    protected function getLogEntry()
    {
        $mock = Mockery::mock('Net\Bazzline\Component\Logger\LogEntry\LogEntry');

        return $mock;
    }

    /**
     * @param LogEntryInterface $logEntry
     * @return Mockery\MockInterface|\Net\Bazzline\Component\Logger\LogEntry\LogEntryRuntimeBuffer
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-27
     */
    protected function getLogEntryRuntimeBuffer(LogEntryInterface $logEntry)
    {
        $mock = Mockery::mock('Net\Bazzline\Component\Logger\LogEntry\LogEntryRuntimeBuffer');

        $mock->shouldReceive('attach')
            ->with($logEntry)
            ->once()
            ->byDefault();

        return $mock;
    }

    /**
     * @return Mockery\MockInterface|\Net\Bazzline\Component\Logger\LogEntry\LogEntryFactory
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-28
     */
    protected function getPlainLogEntryFactory()
    {
        $mock = Mockery::mock('Net\Bazzline\Component\Logger\LogEntry\LogEntryFactory');

        return $mock;
    }

    /**
     * @param LogEntryInterface $logEntry
     * @return Mockery\MockInterface|\Net\Bazzline\Component\Logger\LogEntry\LogEntryFactory
     * @author stev leibelt <artodeto@arcor.de>
     * @since
     */
    protected function getLogEntryFactory(LogEntryInterface $logEntry)
    {
        $mock = $this->getPlainLogEntryFactory();
        $mock->shouldReceive('create')
            ->andReturn($logEntry)
            ->once()
            ->byDefault();

        return $mock;
    }

    /**
     * @return Mockery\MockInterface|\Net\Bazzline\Component\Logger\LogEntry\LogEntryRuntimeBufferFactory
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-27
     */
    protected function getPlainLogEntryBufferFactory()
    {
        $mock = Mockery::mock('Net\Bazzline\Component\Logger\LogEntry\LogEntryRuntimeBufferFactory');

        return $mock;
    }

    /**
     * @param LogEntryBufferInterface $buffer
     * @return Mockery\MockInterface|\Net\Bazzline\Component\Logger\LogEntry\LogEntryRuntimeBufferFactory
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-27
     */
    protected function getLogEntryBufferFactory(LogEntryBufferInterface $buffer)
    {
        $mock = $this->getPlainLogEntryBufferFactory();
        $mock->shouldReceive('create')
            ->andReturn($buffer)
            ->twice()
            ->byDefault();

        return $mock;
    }
}
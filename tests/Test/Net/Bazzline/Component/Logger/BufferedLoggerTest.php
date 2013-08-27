<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 8/27/13
 */

namespace Test\Net\Bazzline\Component\Logger;

use Net\Bazzline\Component\Logger\BufferedLogger;
use Mockery;

/**
 * Class BufferedLoggerTest
 *
 * @package Test\Net\Bazzline\Component\Logger
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-08-27
 */
class BufferedLoggerTest extends TestCase
{
    public function testLog()
    {
        $logger = $this->getNewBufferedLogger();
        $logger->injectLogEntryFactory($this->getLogEntryFactory());
        $logger->injectLogEntryBufferFactory($this->getLogEntryBufferFactory());
    }

    /**
     * @return BufferedLogger
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-27
     */
    protected function getNewBufferedLogger()
    {
        return new BufferedLogger();
    }

    /**
     * @return Mockery\MockInterface|\Net\Bazzline\Component\Logger\LogEntry
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-27
     */
    private function getLogEntry()
    {
        $mock = Mockery::mock('Net\Bazzline\Component\Logger\LogEntry');

        return $mock;
    }

    /**
     * @return Mockery\MockInterface|\Net\Bazzline\Component\Logger\LogEntryFactory
     * @author stev leibelt <artodeto@arcor.de>
     * @since
     */
    protected function getLogEntryFactory()
    {
        $mock = Mockery::mock('Net\Bazzline\Component\Logger\LogEntryFactory');
        $mock->shouldReceive('create')
            ->andReturn($this->getLogEntry())
            ->once();

        return $mock;
    }

    protected function getLogEntryBufferFactory()
    {
        //@todo
    }
}
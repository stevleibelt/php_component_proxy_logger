<?php
/**
 * @author stev leibelt <artodeot@arcor.de>
 * @since 2013-08-26
 */

namespace Test\Net\Bazzline\Component\LogLevelTriggered;

use Net\Bazzline\Component\LogLevelTriggered\LogEntryCollection;
use Mockery;
use Psr\Log\LogLevel;

/**
 * Class LogEntryCollection
 *
 * @package Test\Net\Bazzline\Component\LogLevelTriggered
 * @author stev leibelt <artodeot@arcor.de>
 * @since 2013-08-26
 */
class LogEntryCollectionTest extends TestCase
{
    /**
     * @author stev leibelt <artodeot@arcor.de>
     * @since 2013-08-26
     */
    public function testAdd()
    {
        $collection = $this->getNewCollection();
        $collection->add($this->getNewEntry());

        $this->assertEquals(1, $collection->count());
    }

    /**
     * @return Mockery\MockInterface|\Net\Bazzline\Component\LogLevelTriggered\LogEntry
     * @author stev leibelt <artodeot@arcor.de>
     * @since 2013-08-26
     */
    private function getNewEntry()
    {
        $mock = Mockery::mock('Net\Bazzline\Component\LogLevelTriggered\LogEntry');

        $mock->shouldReceive('getLevel')
            ->andReturn(LogLevel::DEBUG)
            ->once()
            ->byDefault();

        $mock->shouldReceive('getMessage')
            ->andReturn('the message is love')
            ->once()
            ->byDefault();

        $mock->shouldReceive('getContext')
            ->andReturn(array())
            ->once()
            ->byDefault();

        return $mock;
    }

    /**
     * @return LogEntryCollection
     * @author stev leibelt <artodeot@arcor.de>
     * @since 2013-08-26
     */
    private function getNewCollection()
    {
        return new LogEntryCollection;
    }
}
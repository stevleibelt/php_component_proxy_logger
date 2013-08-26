<?php
/**
 * @author stev leibelt <artodeot@arcor.de>
 * @since 2013-08-26
 */

namespace Test\Net\Bazzline\Component\Logger;

use Net\Bazzline\Component\Logger\LogEntryCollection;
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
     * @return Mockery\MockInterface|\Net\Bazzline\Component\Logger\LogEntry
     * @author stev leibelt <artodeot@arcor.de>
     * @since 2013-08-26
     */
    private function getNewEntry()
    {
        $mock = Mockery::mock('Net\Bazzline\Component\Logger\LogEntry');

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
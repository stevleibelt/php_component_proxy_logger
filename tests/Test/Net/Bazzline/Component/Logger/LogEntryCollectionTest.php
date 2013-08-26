<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-08-26
 */

namespace Test\Net\Bazzline\Component\Logger;

use Net\Bazzline\Component\Logger\LogEntryCollection;
use Mockery;

/**
 * Class LogEntryCollection
 *
 * @package Test\Net\Bazzline\Component\Logger
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-08-26
 */
class LogEntryCollectionTest extends TestCase
{
    /**
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-26
     */
    public function testAttach()
    {
        $collection = $this->getNewCollection();
        $collection->attach($this->getNewEntry());

        $this->assertEquals(1, $collection->count());
    }

    /**
     * @return Mockery\MockInterface|\Net\Bazzline\Component\Logger\LogEntry
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-26
     */
    private function getNewEntry()
    {
        $mock = Mockery::mock('Net\Bazzline\Component\Logger\LogEntry');

        return $mock;
    }

    /**
     * @return LogEntryCollection
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-26
     */
    private function getNewCollection()
    {
        return new LogEntryCollection;
    }
}
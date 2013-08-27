<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-08-26
 */

namespace Test\Net\Bazzline\Component\Logger;

use Net\Bazzline\Component\Logger\LogEntryRuntimeBuffer;
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
     * @since 2013-08-27
     */
    public function testCreation()
    {
        $collection = $this->getNewCollection();
        $entry = $this->getNewEntry();

        $this->assertEquals(0, $collection->count());
        $this->assertFalse($collection->contains($entry));
    }

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
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-26
     */
    public function testContains()
    {
        $collection = $this->getNewCollection();
        $entry = $this->getNewEntry();
        $collection->attach($entry);

        $this->assertTrue($collection->contains($entry));
    }

    /**
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-26
     */
    public function testDetach()
    {
        $collection = $this->getNewCollection();
        $entry = $this->getNewEntry();
        //no error expected when detaching a not attached entry
        $collection->detach($entry);
        //now attach and detach entry
        $collection->attach($entry);
        $collection->detach($entry);

        $this->assertEquals(0, $collection->count());
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
     * @return LogEntryRuntimeBuffer
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-26
     */
    private function getNewCollection()
    {
        return new LogEntryRuntimeBuffer;
    }
}
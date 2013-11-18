<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-11-18 
 */

namespace Test\Net\Bazzline\Component\ProxyLogger\Event;

use Net\Bazzline\Component\ProxyLogger\Event\BufferEvent;
use Test\Net\Bazzline\Component\ProxyLogger\TestCase;

/**
 * Class BufferEventTest
 * @package Test\Net\Bazzline\Component\ProxyLogger\Event
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-11-18
 */
class BufferEventTest extends TestCase
{
    /**
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-11-18
     */
    public function testGetAddLogRequestToBuffer()
    {
        $event = $this->getNewEvent();

        $this->assertEquals($event->getAddLogRequestToBuffer(), BufferEvent::ADD_LOG_REQUEST_TO_BUFFER);
    }

    /**
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-11-18
     */
    public function getBufferClear()
    {
        $event = $this->getNewEvent();

        $this->assertEquals($event->getBufferClean(), BufferEvent::BUFFER_CLEAN);
    }

    /**
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-11-18
     */
    public function getBufferFlush()
    {
        $event = $this->getNewEvent();

        $this->assertEquals($event->getBufferFlush(), BufferEvent::BUFFER_FLUSH);
    }

    /**
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-11-18
     */
    public function testGetHasSetLogRequestBuffer()
    {
        $this->markTestIncomplete('todo');
    }

    /**
     * @return BufferEvent
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-11-18
     */
    private function getNewEvent()
    {
        return new BufferEvent();
    }
} 
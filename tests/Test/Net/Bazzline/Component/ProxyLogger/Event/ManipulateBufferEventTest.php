<?php
/**
 * @author stev leibelt <artodeto@bazzline.net>
 * @since 2013-11-18 
 */

namespace Test\Net\Bazzline\Component\ProxyLogger\Event;

use Net\Bazzline\Component\ProxyLogger\Event\ManipulateBufferEvent;
use Test\Net\Bazzline\Component\ProxyLogger\TestCase;

/**
 * Class ManipulateBufferEventTest
 * @package Test\Net\Bazzline\Component\ProxyLogger\Event
 * @author stev leibelt <artodeto@bazzline.net>
 * @since 2013-11-18
 */
class ManipulateBufferEventTest extends TestCase
{
    /**
     * @author stev leibelt <artodeto@bazzline.net>
     * @since 2013-11-18
     */
    public function testGetHasSetBypassBuffer()
    {
        $event = $this->getNewEvent();
        $bypassBuffer = $this->getNewBypassBufferMock();

        $this->assertFalse($event->hasBypassBuffer());
        $this->assertNull($event->getBypassBuffer());
        $this->assertSame($event, $event->setBypassBuffer($bypassBuffer));
        $this->assertTrue($event->hasBypassBuffer());
        $this->assertSame($bypassBuffer, $event->getBypassBuffer());
    }

    /**
     * @author stev leibelt <artodeto@bazzline.net>
     * @since 2013-11-18
     */
    public function testGetHasSetFlushBufferTrigger()
    {
        $event = $this->getNewEvent();
        $flushBufferTrigger = $this->getNewAbstractFlushBufferTriggerMock();

        $this->assertFalse($event->hasFlushBufferTrigger());
        $this->assertNull($event->getFlushBufferTrigger());
        $this->assertSame($event, $event->setFlushBufferTrigger($flushBufferTrigger));
        $this->assertTrue($event->hasFlushBufferTrigger());
        $this->assertSame($flushBufferTrigger, $event->getFlushBufferTrigger());
    }

    /**
     * @return ManipulateBufferEvent
     * @author stev leibelt <artodeto@bazzline.net>
     * @since 2013-11-20
     */
    private function getNewEvent()
    {
        return new ManipulateBufferEvent();
    }
}
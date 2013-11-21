<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-11-18 
 */

namespace Test\Net\Bazzline\Component\ProxyLogger\EventListener;

use Net\Bazzline\Component\ProxyLogger\Event\ProxyEvent;
use Net\Bazzline\Component\ProxyLogger\EventListener\ProxyEventListener;
use Test\Net\Bazzline\Component\ProxyLogger\TestCase;

/**
 * Class ProxyEventListenerTest
 * @package Test\Net\Bazzline\Component\ProxyLogger\EventListener
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-11-18
 */
class ProxyEventListenerTest extends TestCase
{
    /**
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-11-18
     */
    public function testAttach()
    {
        $listener = $this->getNewEventListener();
        $dispatcher = $this->getNewEventDispatcher();

        $this->assertSame($listener, $listener->attach($dispatcher));
        $this->assertTrue($dispatcher->hasListeners(ProxyEvent::LOG_LOG_REQUEST));
    }

    /**
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-11-18
     */
    public function testDetach()
    {
        $listener = $this->getNewEventListener();
        $dispatcher = $this->getNewEventDispatcher();
        $listener->attach($dispatcher);

        $this->assertSame($listener, $listener->detach($dispatcher));
        $this->assertFalse($dispatcher->hasListeners(ProxyEvent::LOG_LOG_REQUEST));
    }

    /**
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-11-18
     */
    public function testLogRequest()
    {
        $listener = $this->getNewEventListener();
        $event = $this->getNewBufferEventMock();

        $event->shouldReceive('getLoggerCollection')
            ->andReturn(array())
            ->once();
        $event->shouldReceive('getLogRequest')
            ->once();

        $listener->logRequest($event);
    }

    /**
     * @return ProxyEventListener
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-11-21
     */
    private function getNewEventListener()
    {
        return new ProxyEventListener();
    }
} 
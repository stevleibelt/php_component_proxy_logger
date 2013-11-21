<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-11-18 
 */

namespace Test\Net\Bazzline\Component\ProxyLogger\EventListener;

use Net\Bazzline\Component\ProxyLogger\Event\ProxyEvent;
use Net\Bazzline\Component\ProxyLogger\Event\BufferEvent;
use Net\Bazzline\Component\ProxyLogger\EventListener\BufferEventListener;
use Test\Net\Bazzline\Component\ProxyLogger\TestCase;

/**
 * Class BufferEventListenerTest
 * @package Test\Net\Bazzline\Component\ProxyLogger\EventListener
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-11-18
 */
class BufferEventListenerTest extends TestCase
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
        $this->assertTrue($dispatcher->hasListeners(BufferEvent::ADD_LOG_REQUEST_TO_BUFFER));
        $this->assertTrue($dispatcher->hasListeners(BufferEvent::BUFFER_CLEAN));
        $this->assertTrue($dispatcher->hasListeners(BufferEvent::BUFFER_FLUSH));
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
        $this->assertFalse($dispatcher->hasListeners(BufferEvent::ADD_LOG_REQUEST_TO_BUFFER));
        $this->assertFalse($dispatcher->hasListeners(BufferEvent::BUFFER_CLEAN));
        $this->assertFalse($dispatcher->hasListeners(BufferEvent::BUFFER_FLUSH));
    }

    /**
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-11-18
     */
    public function testAddLogRequestToBuffer()
    {
        $listener = $this->getNewEventListener();
        $event = $this->getNewBufferEventMock();
        $request = $this->getNewLogRequestMock();
        $buffer = $this->getNewLogRequestRuntimeBufferMock();

        $buffer->shouldReceive('add')
            ->with($request)
            ->once();
        $event->shouldReceive('getLogRequest')
            ->andReturn($request)
            ->once();
        $event->shouldReceive('getLogRequestBuffer')
            ->andReturn($buffer)
            ->once();

        $listener->addLogRequestToBuffer($event);
    }

    /**
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-11-18
     */
    public function testBufferClean()
    {
        $listener = $this->getNewEventListener();
        $event = $this->getNewBufferEventMock();
        $buffer = $this->getNewLogRequestRuntimeBufferMock();

        $event->shouldReceive('getLogRequestBuffer')
            ->andReturn($buffer)
            ->once();
        $event->shouldReceive('setLogRequestBuffer')
            ->once();

        $listener->bufferClean($event);
    }

    /**
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-11-18
     */
    public function testBufferFlush()
    {
        $listener = $this->getNewEventListener();
        $event = $this->getNewBufferEventMock();
        $dispatcher = $this->getNewEventDispatcherMock();
        $buffer = $this->getNewLogRequestRuntimeBufferMock();
        $buffer->shouldReceive('rewind')
            ->once();
        $buffer->shouldReceive('valid')
            ->once();

        $dispatcher->shouldReceive('dispatch')
            ->withArgs(array(BufferEvent::BUFFER_CLEAN, $event))
            ->once();
        $event->shouldReceive('getLogRequestBuffer')
            ->andReturn($buffer)
            ->once();
        $event->shouldReceive('getDispatcher')
            ->andReturn($dispatcher)
            ->once();

        $listener->bufferFlush($event);
    }

    /**
     * @return BufferEventListener
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-11-21
     */
    private function getNewEventListener()
    {
        return new BufferEventListener();
    }
} 
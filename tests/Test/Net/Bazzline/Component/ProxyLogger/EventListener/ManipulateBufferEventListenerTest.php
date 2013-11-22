<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-11-18 
 */

namespace Test\Net\Bazzline\Component\ProxyLogger\EventListener;

use Net\Bazzline\Component\ProxyLogger\Event\ManipulateBufferEvent;
use Net\Bazzline\Component\ProxyLogger\EventListener\ManipulateBufferEventListener;
use Test\Net\Bazzline\Component\ProxyLogger\TestCase;

/**
 * Class ManipulateBufferEventListenerTest
 * @package Test\Net\Bazzline\Component\ProxyLogger\EventListener
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-11-18
 */
class ManipulateBufferEventListenerTest extends TestCase
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
        $this->assertTrue($dispatcher->hasListeners(ManipulateBufferEvent::LOG_LOG_REQUEST));
        $this->assertTrue($dispatcher->hasListeners(ManipulateBufferEvent::ADD_LOG_REQUEST_TO_BUFFER));
        $this->assertTrue($dispatcher->hasListeners(ManipulateBufferEvent::BUFFER_CLEAN));
        $this->assertTrue($dispatcher->hasListeners(ManipulateBufferEvent::BUFFER_FLUSH));
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
        $this->assertFalse($dispatcher->hasListeners(ManipulateBufferEvent::LOG_LOG_REQUEST));
        $this->assertFalse($dispatcher->hasListeners(ManipulateBufferEvent::ADD_LOG_REQUEST_TO_BUFFER));
        $this->assertFalse($dispatcher->hasListeners(ManipulateBufferEvent::BUFFER_CLEAN));
        $this->assertFalse($dispatcher->hasListeners(ManipulateBufferEvent::BUFFER_FLUSH));
    }

    /**
     * @return array
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-11-22
     */
    public static function createAddLogRequestToBufferTestCase()
    {
        $preconditions = array(
            'setBypassBuffer' => true,
            'setFlushBufferTrigger' => true
        );
        $expectations = array(
            'hasBypassBuffer' => true,
            'hasFlushBufferTrigger' => true
        );
        $testCases = array(
            'bypass buffer and flush buffer trigger' => array(
                'preconditions' => array(),
                'expectations' => array()
            ),
            'bypass buffer and no flush buffer trigger' => array(
                'preconditions' => array(
                    'setFlushBufferTrigger' => false
                ),
                'expectations' => array(
                    'hasFlushBufferTrigger' => false
                )
            ),
            'no bypass buffer and flush buffer trigger' => array(
                'preconditions' => array(
                    'setBypassBuffer' => false
                ),
                'expectations' => array(
                    'hasBypassBuffer' => false
                )
            ),
            'no bypass buffer and no flush buffer trigger' => array(
                'preconditions' => array(
                    'setBypassBuffer' => false,
                    'setFlushBufferTrigger' => false
                ),
                'expectations' => array(
                    'hasBypassBuffer' => false,
                    'hasFlushBufferTrigger' => false
                )
            )
        );

        return self::mergeTestCasesWithDefaults($testCases, $preconditions, $expectations);
    }

    /**
     * @dataProvider createAddLogRequestToBufferTestCase
     *
     * @param array $preconditions
     * @param array $expectations
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-11-18
     * @todo extend with all test cases
     *  - (hasBypassBuffer^!hasFlushBuffer)
     *  - (!hasBypassBuffer^hasFlushBuffer)
     *  - (hasBypassBuffer^hasFlushBuffer)
     */
    public function testAddLogRequestToBuffer(array $preconditions, array $expectations)
    {
        $buffer = $this->getNewLogRequestRuntimeBufferMock();
        $dispatcher = $this->getNewEventDispatcher();
        $event = $this->getNewManipulateBufferEventMock();
        $listener = $this->getNewEventListener();
        $request = $this->getNewLogRequestMock();
        $level = 'test_level';
        $numberOfGetRequestCalls = 0;

        if ($preconditions['setBypassBuffer']) {
            $bypassBuffer = $this->getNewBypassBufferMock();
            $numberOfGetRequestCalls++;
            //@todo create test case that defines return value
            $bypassBuffer->shouldReceive('bypassBuffer')
                ->andReturn(false)
                ->once();
            $event->shouldReceive('getBypassBuffer')
                ->andReturn($bypassBuffer)
                ->once();
        }

        if ($preconditions['setFlushBufferTrigger']) {
            $flushBufferTrigger = $this->getNewFlushBufferTriggerMock();
            $numberOfGetRequestCalls++;
            //@todo create test case that defines return value
            $flushBufferTrigger->shouldReceive('triggerBufferFlush')
                ->andReturn(false)
                ->once();
            $event->shouldReceive('getFlushBufferTrigger')
                ->andReturn($flushBufferTrigger)
                ->once();
        }

        $request->shouldReceive('getLevel')
            ->andReturn($level)
            ->times($numberOfGetRequestCalls);

        $buffer->shouldReceive('add')
            ->withArgs(array($request))
            ->once();
        $event->shouldReceive('getLogRequestBuffer')
            ->andReturn($buffer)
            ->once();
        $event->shouldReceive('getLogRequest')
            ->andReturn($request)
            ->once();
        $event->shouldReceive('hasBypassBuffer')
            ->andReturn($expectations['hasBypassBuffer'])
            ->once();
        $event->shouldReceive('hasFlushBufferTrigger')
            ->andReturn($expectations['hasFlushBufferTrigger'])
            ->once();
        $event->shouldReceive('getDispatcher')
            ->andReturn($dispatcher)
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
        $event = $this->getNewManipulateBufferEventMock();
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
        $event = $this->getNewManipulateBufferEventMock();
        $dispatcher = $this->getNewEventDispatcherMock();
        $buffer = $this->getNewLogRequestRuntimeBufferMock();
        $buffer->shouldReceive('rewind')
            ->once();
        $buffer->shouldReceive('valid')
            ->once();

        $dispatcher->shouldReceive('dispatch')
            ->withArgs(array(ManipulateBufferEvent::BUFFER_CLEAN, $event))
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
     * @return ManipulateBufferEventListener
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-11-21
     */
    private function getNewEventListener()
    {
        return new ManipulateBufferEventListener();
    }
}

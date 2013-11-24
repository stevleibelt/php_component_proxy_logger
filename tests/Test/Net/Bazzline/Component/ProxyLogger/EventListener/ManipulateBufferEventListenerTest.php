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
            'setFlushBufferTrigger' => true,
            'triggerBufferFlush' => false,
            'bypassBuffer' => false
        );
        $expectations = array(
            'hasBypassBuffer' => true,
            'hasFlushBufferTrigger' => true
        );
        $testCases = array(
            'setBypassBuffer and setFlushBufferTrigger' => array(
                'preconditions' => array(),
                'expectations' => array()
            ),
            'setBypassBuffer and bypassBuffer and setFlushBufferTrigger and flushBufferTrigger' => array(
                'preconditions' => array(
                    'triggerBufferFlush' => true,
                    'bypassBuffer' => true
                ),
                'expectations' => array()
            ),
            'setBypassBuffer and setFlushBufferTrigger and flushBufferTrigger' => array(
                'preconditions' => array(
                    'triggerBufferFlush' => true
                ),
                'expectations' => array()
            ),
            'TODO::setBypassBuffer and bypassBuffer and setFlushBufferTrigger' => array(
                'preconditions' => array(
                    'bypassBuffer' => true
                ),
                'expectations' => array()
            ),
            'setBypassBuffer and no setFlushBufferTrigger' => array(
                'preconditions' => array(
                    'setFlushBufferTrigger' => false
                ),
                'expectations' => array(
                    'hasFlushBufferTrigger' => false
                )
            ),
            'setBypassBuffer and bypassBuffer and no setFlushBufferTrigger' => array(
                'preconditions' => array(
                    'bypassBuffer' => true,
                    'setFlushBufferTrigger' => false
                ),
                'expectations' => array(
                    'hasFlushBufferTrigger' => false
                )
            ),
            'no setBypassBuffer and setFlushBufferTrigger' => array(
                'preconditions' => array(
                    'setBypassBuffer' => false
                ),
                'expectations' => array(
                    'hasBypassBuffer' => false
                )
            ),
            'TODO::no BypassBuffer and setFlushBufferTrigger and flushBufferTrigger' => array(
                'preconditions' => array(
                    'triggerBufferFlush' => true,
                    'setBypassBuffer' => false
                ),
                'expectations' => array(
                    'hasBypassBuffer' => false
                )
            ),
            'no setBypassBuffer and no setFlushBufferTrigger' => array(
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
        $numberOfSetDispatcher = 0;
        $numberOfAddCalls = 0;
        $numberOfSetNameLogLogRequest = 0;
        $numberOfSetNameBufferFlush = 0;

        if ($preconditions['setBypassBuffer']) {
            $bypassBuffer = $this->getNewBypassBufferMock();
            $numberOfGetRequestCalls++;
            $bypassBuffer->shouldReceive('bypassBuffer')
                ->andReturn($preconditions['bypassBuffer'])
                ->once();
            $event->shouldReceive('getBypassBuffer')
                ->andReturn($bypassBuffer)
                ->once();
        }

        if ($preconditions['setFlushBufferTrigger']) {
            $flushBufferTrigger = $this->getNewFlushBufferTriggerMock();
            $numberOfGetRequestCalls++;
            $flushBufferTrigger->shouldReceive('triggerBufferFlush')
                ->andReturn($preconditions['triggerBufferFlush'])
                ->once();
            $event->shouldReceive('getFlushBufferTrigger')
                ->andReturn($flushBufferTrigger)
                ->once();
        }

        if ($preconditions['setBypassBuffer']
            && !$preconditions['setFlushBufferTrigger']) {
            if ($preconditions['bypassBuffer']) {
                ++$numberOfSetDispatcher;
                ++$numberOfSetNameLogLogRequest;
            }
        }
        if ($preconditions['setFlushBufferTrigger']
            && !$preconditions['setBypassBuffer']) {
            if ($preconditions['triggerBufferFlush']) {
                ++$numberOfSetNameLogLogRequest;
                ++$numberOfSetNameBufferFlush;
                $numberOfSetDispatcher += 2;
            }
        }
        if ($preconditions['setBypassBuffer']
            && $preconditions['setFlushBufferTrigger']) {
            if ($preconditions['bypassBuffer']
                && $preconditions['triggerBufferFlush']) {
                ++$numberOfSetNameLogLogRequest;
                ++$numberOfSetNameBufferFlush;
                $numberOfSetDispatcher += 2;
            }
            if (!$preconditions['bypassBuffer']
                && !$preconditions['triggerBufferFlush']) {
                ++$numberOfAddCalls;
            }
            if ($preconditions['bypassBuffer']
                && !$preconditions['triggerBufferFlush']) {
                ++$numberOfAddCalls;
                ++$numberOfSetDispatcher;
                ++$numberOfSetNameLogLogRequest;
            }
            if (!$preconditions['bypassBuffer']
                && $preconditions['triggerBufferFlush']) {
                $numberOfSetDispatcher += 2;
                ++$numberOfSetNameLogLogRequest;
                ++$numberOfSetNameBufferFlush;
            }
        } else {
            if (!$preconditions['bypassBuffer']
                && !$preconditions['triggerBufferFlush']) {
                ++$numberOfAddCalls;
            }
        }

        $event->shouldReceive('setName')
            ->with(ManipulateBufferEvent::LOG_LOG_REQUEST)
            ->times($numberOfSetNameLogLogRequest);
        $event->shouldReceive('setName')
            ->with(ManipulateBufferEvent::BUFFER_FLUSH)
            ->times($numberOfSetNameBufferFlush);
        $request->shouldReceive('getLevel')
            ->andReturn($level)
            ->times($numberOfGetRequestCalls);
        $event->shouldReceive('setDispatcher')
            ->with($dispatcher)
            ->times($numberOfSetDispatcher);

        $buffer->shouldReceive('add')
            ->withArgs(array($request))
            ->times($numberOfAddCalls);
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

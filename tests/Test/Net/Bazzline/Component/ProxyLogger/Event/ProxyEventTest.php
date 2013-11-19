<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-11-18 
 */

namespace Test\Net\Bazzline\Component\ProxyLogger\Event;

use Net\Bazzline\Component\ProxyLogger\Event\ProxyEvent;
use Test\Net\Bazzline\Component\ProxyLogger\TestCase;

/**
 * Class ProxyEventTest
 * @package Test\Net\Bazzline\Component\ProxyLogger\Event
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-11-18
 */
class ProxyEventTest extends TestCase
{
    /**
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-11-19
     */
    public function testGetLogLogRequest()
    {
        $event = $this->getNewEvent();

        $this->assertEquals(ProxyEvent::LOG_LOG_REQUEST, $event->getLogLogRequest());
    }

    /**
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-11-18
     */
    public function testGetSetLogRequest()
    {
        $event = $this->getNewEvent();
        $request = $this->getNewLogRequestMock();

        $this->assertNull($event->getLogRequest());
        $this->assertEquals($event, $event->setLogRequest($request));
        $this->assertEquals($request, $event->getLogRequest());
    }

    /**
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-11-18
     */
    public function testGetSetLoggerCollection()
    {
        $event = $this->getNewEvent();
        $loggerCollection = array(
            $this->getNewPsr3LoggerMock(),
            $this->getNewPsr3LoggerMock()
        );

        $this->assertEquals(array(), $event->getLoggerCollection());
        $this->assertEquals($event, $event->setLoggerCollection($loggerCollection));
        $this->assertEquals($loggerCollection, $event->getLoggerCollection());
    }

    /**
     * @return ProxyEvent
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-11-19
     */
    public function getNewEvent()
    {
        return new ProxyEvent();
    }
} 
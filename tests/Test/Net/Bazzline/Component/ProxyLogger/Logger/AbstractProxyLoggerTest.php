<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-11-13 
 */

namespace Test\Net\Bazzline\Component\ProxyLogger\Logger;

use Test\Net\Bazzline\Component\ProxyLogger\TestCase;

/**
 * Class AbstractProxyLoggerTest
 *
 * @package Test\Net\Bazzline\Component\ProxyLogger\Logger
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-11-13
 */
class AbstractProxyLoggerTest extends TestCase
{

    /**
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-28
     */
    public function testAddLogger()
    {
        $logger = $this->getNewLogger();

        $this->assertEquals($logger, $logger->addLogger($this->getNewPsr3LoggerMock()));
    }

    /**
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-11-18
     */
    public function testGetLoggers()
    {
        $logger = $this->getNewLogger();

        $this->assertNull($logger->getLoggers());
        $this->assertEquals($logger, $logger->addLogger($this->getNewPsr3LoggerMock()));
        $this->assertEquals(1, count($logger->getLoggers()));
    }

    /**
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-09-06
     */
    public function testSetLogRequestFactory()
    {
        $logger = $this->getNewLogger();

        $factory = $this->getNewPlainLogRequestFactoryMock();
        $this->assertEquals($logger, $logger->setLogRequestFactory($factory));
    }

    /**
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-11-13
     */
    public function testSetEvent()
    {
        $logger = $this->getNewLogger();
        $event = $this->getNewEventMock();

        $this->assertEquals($logger, $logger->setEvent($event));
    }

    /**
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-11-13
     */
    public function testSetEventDispatcher()
    {
        $logger = $this->getNewLogger();
        $dispatcher = $this->getNewEventDispatcherMock();

        $this->assertEquals($logger, $logger->setEventDispatcher($dispatcher));
    }

    /**
     * @return \Mockery\MockInterface|\Net\Bazzline\Component\ProxyLogger\Logger\AbstractProxyLogger
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-11-13
     */
    protected function getNewLogger()
    {
        return $this->getNewAbstractProxyLogger();
    }
}
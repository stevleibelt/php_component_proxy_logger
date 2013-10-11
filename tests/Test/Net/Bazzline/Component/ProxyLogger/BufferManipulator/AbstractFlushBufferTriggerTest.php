<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-09-06
 */

namespace Test\Net\Bazzline\Component\ProxyLogger\BufferManipulator;

use Mockery;
use Psr\Log\LogLevel;
use Test\Net\Bazzline\Component\ProxyLogger\TestCase;

/**
 * Class AbstractFlushBufferTriggerTest
 *
 * @package Test\Net\Bazzline\Component\ProxyLogger\BufferManipulator
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-09-06
 */
class AbstractFlushBufferTriggerTest extends TestCase
{
    /**
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-09-06
     */
    public function testSetTriggerToEmergency()
    {
        $flushBufferTrigger = $this->getNewAbstractFlushBufferTrigger();
        $this->assertFalse($flushBufferTrigger->hasTrigger());

        $flushBufferTrigger->setTriggerToEmergency();

        $this->assertTrue($flushBufferTrigger->hasTrigger());
        $this->assertEquals(LogLevel::EMERGENCY, $flushBufferTrigger->getTrigger());
    }

    /**
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-09-06
     */
    public function testSetTriggerToAlert()
    {
        $flushBufferTrigger = $this->getNewAbstractFlushBufferTrigger();
        $this->assertFalse($flushBufferTrigger->hasTrigger());

        $flushBufferTrigger->setTriggerToAlert();

        $this->assertTrue($flushBufferTrigger->hasTrigger());
        $this->assertEquals(LogLevel::ALERT, $flushBufferTrigger->getTrigger());
    }

    /**
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-09-06
     */
    public function testSetTriggerToCritical()
    {
        $flushBufferTrigger = $this->getNewAbstractFlushBufferTrigger();
        $this->assertFalse($flushBufferTrigger->hasTrigger());

        $flushBufferTrigger->setTriggerToCritical();

        $this->assertTrue($flushBufferTrigger->hasTrigger());
        $this->assertEquals(LogLevel::CRITICAL, $flushBufferTrigger->getTrigger());
    }

    /**
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-09-06
     */
    public function testSetTriggerToError()
    {
        $flushBufferTrigger = $this->getNewAbstractFlushBufferTrigger();
        $this->assertFalse($flushBufferTrigger->hasTrigger());

        $flushBufferTrigger->setTriggerToError();

        $this->assertTrue($flushBufferTrigger->hasTrigger());
        $this->assertEquals(LogLevel::ERROR, $flushBufferTrigger->getTrigger());
    }

    /**
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-09-06
     */
    public function testSetTriggerToWarning()
    {
        $flushBufferTrigger = $this->getNewAbstractFlushBufferTrigger();
        $this->assertFalse($flushBufferTrigger->hasTrigger());

        $flushBufferTrigger->setTriggerToWarning();

        $this->assertTrue($flushBufferTrigger->hasTrigger());
        $this->assertEquals(LogLevel::WARNING, $flushBufferTrigger->getTrigger());
    }

    /**
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-09-06
     */
    public function testSetTriggerToNotice()
    {
        $flushBufferTrigger = $this->getNewAbstractFlushBufferTrigger();
        $this->assertFalse($flushBufferTrigger->hasTrigger());

        $flushBufferTrigger->setTriggerToNotice();

        $this->assertTrue($flushBufferTrigger->hasTrigger());
        $this->assertEquals(LogLevel::NOTICE, $flushBufferTrigger->getTrigger());
    }
    /**
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-09-06
     */
    public function testSetTriggerToInfo()
    {
        $flushBufferTrigger = $this->getNewAbstractFlushBufferTrigger();
        $this->assertFalse($flushBufferTrigger->hasTrigger());

        $flushBufferTrigger->setTriggerToInfo();

        $this->assertTrue($flushBufferTrigger->hasTrigger());
        $this->assertEquals(LogLevel::INFO, $flushBufferTrigger->getTrigger());
    }

    /**
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-09-06
     */
    public function testSetTriggerToDebug()
    {
        $flushBufferTrigger = $this->getNewAbstractFlushBufferTrigger();
        $this->assertFalse($flushBufferTrigger->hasTrigger());

        $flushBufferTrigger->setTriggerToDebug();

        $this->assertTrue($flushBufferTrigger->hasTrigger());
        $this->assertEquals(LogLevel::DEBUG, $flushBufferTrigger->getTrigger());
    }

    /**
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-09-06
     */
    public function testSetTriggerTo()
    {
        $flushBufferTrigger = $this->getNewAbstractFlushBufferTrigger();
        $this->assertFalse($flushBufferTrigger->hasTrigger());

        $flushBufferTrigger->setTriggerTo(LogLevel::DEBUG);

        $this->assertTrue($flushBufferTrigger->hasTrigger());
        $this->assertEquals(LogLevel::DEBUG, $flushBufferTrigger->getTrigger());
    }

    /**
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-09-06
     */
    public function testSetInvalidTriggerToWithoutIsValidLogLevel()
    {
        $flushBufferTrigger = $this->getNewAbstractFlushBufferTrigger();
        $myLogLevel = 'love';
        $this->assertFalse($flushBufferTrigger->hasTrigger());

        $flushBufferTrigger->setTriggerTo($myLogLevel);

        $this->assertTrue($flushBufferTrigger->hasTrigger());
        $this->assertEquals($myLogLevel, $flushBufferTrigger->getTrigger());
    }

    /**
     * @expectedException \Psr\Log\InvalidArgumentException
     * @expectedExceptionMessage no valid log level provided
     *
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-09-06
     */
    public function testSetInvalidTriggerToWithIsValidLogLevel()
    {
        $flushBufferTrigger = $this->getNewAbstractFlushBufferTrigger();
        $myLogLevel = 'love';
        $this->assertFalse($flushBufferTrigger->hasTrigger());

        $isValidLogLevel = $this->getIsValidLogLevel();
        $isValidLogLevel->shouldReceive('setLogLevel')
            ->with($myLogLevel)
            ->andReturn($isValidLogLevel)
            ->once();
        $isValidLogLevel->shouldReceive('isMet')
            ->andReturn(false)
            ->once();
        $flushBufferTrigger->setIsValidLogLevel($isValidLogLevel);
        $flushBufferTrigger->setTriggerTo($myLogLevel);

        $this->assertTrue($flushBufferTrigger->hasTrigger());
        $this->assertEquals($myLogLevel, $flushBufferTrigger->getTrigger());
    }

    /**
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-09-06
     */
    public function testGetHasSetValidLogLevel()
    {
        $flushBufferTrigger = $this->getNewAbstractFlushBufferTrigger();
        $this->assertFalse($flushBufferTrigger->hasIsValidLogLevel());

        $isValidLogLevel = $this->getIsValidLogLevel();
        $flushBufferTrigger->setIsValidLogLevel($isValidLogLevel);

        $this->assertTrue($flushBufferTrigger->hasIsValidLogLevel());
        $this->assertEquals($isValidLogLevel, $flushBufferTrigger->getIsValidLogLevel());
    }
}
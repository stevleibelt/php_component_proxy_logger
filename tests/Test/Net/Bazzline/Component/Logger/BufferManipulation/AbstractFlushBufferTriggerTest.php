<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-09-06
 */

namespace Test\Net\Bazzline\Component\Logger\BufferManipulation;

use Mockery;
use Psr\Log\LogLevel;
use Test\Net\Bazzline\Component\Logger\TestCase;

/**
 * Class AbstractFlushBufferTriggerTest
 *
 * @package Test\Net\Bazzline\Component\Logger\BufferManipulation
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
        $flushBufferTrigger->setTriggerToAlert();

        $this->assertTrue($flushBufferTrigger->hasTrigger());
        $this->assertEquals(LogLevel::ALERT, $flushBufferTrigger->getTrigger());
    }

    /**
     * @return Mockery\MockInterface|\Net\Bazzline\Component\Logger\BufferManipulation\AlwaysFlushBufferTrigger
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-09-06
     */
    private function getNewAbstractFlushBufferTrigger()
    {
        return Mockery::mock('Net\Bazzline\Component\Logger\BufferManipulation\AlwaysFlushBufferTrigger[triggerBufferFlush]');
    }
}
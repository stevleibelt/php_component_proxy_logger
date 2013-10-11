<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-09-06 
 */

namespace Test\Net\Bazzline\Component\ProxyLogger\BufferManipulator;

use Net\Bazzline\Component\ProxyLogger\BufferManipulator\AlwaysFlushBufferTrigger;
use Test\Net\Bazzline\Component\ProxyLogger\TestCase;
use Psr\Log\LogLevel;

/**
 * Class AlwaysFlushBufferTriggerTest
 *
 * @package Test\Net\Bazzline\Component\ProxyLogger\BufferManipulator
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-09-06
 */
class AlwaysFlushBufferTriggerTest extends TestCase
{
    /**
     * @return array
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-09-06
     */
    public static function testCaseDataProvider()
    {
        return array(
            'no log level set no trigger' => array(
                'logLevel' => null,
                'logLevelToTrigger' => null,
                'expectedAvoidBuffering' => true
            ),
            'log level set but not trigger' => array(
                'logLevelToAdd' => LogLevel::INFO,
                'logLevelToTrigger' => null,
                'expectedTriggerBufferFlush' => true
            ),
            'log level set but different trigger' => array(
                'logLevelToAdd' => LogLevel::DEBUG,
                'logLevelToTrigger' => LogLevel::INFO,
                'expectedTriggerBufferFlush' => true
            ),
            'log level set and same to trigger' => array(
                'logLevelToAdd' => LogLevel::INFO,
                'logLevelToTrigger' => LogLevel::INFO,
                'expectedTriggerBufferFlush' => true
            )
        );
    }

    /**
     * @dataProvider testCaseDataProvider
     *
     * @param mixed $logLevelToAdd
     * @param mixed $logLevelToTrigger
     * @param bool $expectedTriggerBufferFlush
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-09-06
     */
    public function testTriggerBufferFlush($logLevelToAdd, $logLevelToTrigger, $expectedTriggerBufferFlush)
    {
        $flushBufferTrigger = new AlwaysFlushBufferTrigger();
        if (!is_null($logLevelToTrigger)) {
            $flushBufferTrigger->setTriggerTo($logLevelToTrigger);
        }

        $this->assertEquals($expectedTriggerBufferFlush, $flushBufferTrigger->triggerBufferFlush($logLevelToAdd));
    }
}
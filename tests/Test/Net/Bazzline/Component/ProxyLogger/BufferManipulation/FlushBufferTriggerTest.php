<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-09-06
 */

namespace Test\Net\Bazzline\Component\ProxyLogger\BufferManipulation;

use Net\Bazzline\Component\ProxyLogger\BufferManipulation\FlushBufferTrigger;
use Test\Net\Bazzline\Component\ProxyLogger\TestCase;
use Psr\Log\LogLevel;

/**
 * Class FlushBufferTriggerTest
 *
 * @package Test\Net\Bazzline\Component\ProxyLogger\BufferManipulation
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-09-06
 */
class FlushBufferTriggerTest extends TestCase
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
                'expectedAvoidBuffering' => false
            ),
            'log level set but not trigger' => array(
                'logLevelToAdd' => LogLevel::INFO,
                'logLevelToTrigger' => null,
                'expectedTriggerBufferFlush' => false
            ),
            'log level set but different trigger' => array(
                'logLevelToAdd' => LogLevel::DEBUG,
                'logLevelToTrigger' => LogLevel::INFO,
                'expectedTriggerBufferFlush' => false
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
        $flushBufferTrigger = new FlushBufferTrigger();
        if (!is_null($logLevelToTrigger)) {
            $flushBufferTrigger->setTriggerTo($logLevelToTrigger);
        }

        $this->assertEquals($expectedTriggerBufferFlush, $flushBufferTrigger->triggerBufferFlush($logLevelToAdd));
    }
}
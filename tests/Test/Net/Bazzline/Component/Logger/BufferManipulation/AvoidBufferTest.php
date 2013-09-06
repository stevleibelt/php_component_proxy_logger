<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-09-05 
 */

namespace Test\Net\Bazzline\Component\Logger\BufferManipulation;

use Net\Bazzline\Component\Logger\BufferManipulation\AvoidBuffer;
use Psr\Log\LogLevel;
use Test\Net\Bazzline\Component\DataType\TestCase;

/**
 * Class AvoidBufferTest
 *
 * @package Test\Net\Bazzline\Component\Logger\BufferManipulation
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-09-05
 */
class AvoidBufferTest extends TestCase
{
    /**
     * @return array
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-09-05
     */
    public static function testCaseDataProvider()
    {
        return array(
            'no log level set no avoided' => array(
                'logLevel' => null,
                'logLevelToAvoid' => null,
                'expectedAvoidBuffering' => false
            ),
            'log level set but not avoided' => array(
                'logLevelToAdd' => LogLevel::INFO,
                'logLevelToAvoid' => null,
                'expectedAvoidBuffering' => false
            ),
            'log level set but different avoided' => array(
                'logLevelToAdd' => LogLevel::DEBUG,
                'logLevelToAvoid' => LogLevel::INFO,
                'expectedAvoidBuffering' => false
            ),
            'log level set and same to avoid' => array(
                'logLevelToAdd' => LogLevel::INFO,
                'logLevelToAvoid' => LogLevel::INFO,
                'expectedAvoidBuffering' => true
            )
        );
    }

    /**
     * @dataProvider testCaseDataProvider
     *
     * @param mixed $logLevel
     * @param mixed $logLevelToAvoid
     * @param bool $expectedAvoidBuffering
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-09-05
     */
    public function testAvoidBuffering($logLevel, $logLevelToAvoid, $expectedAvoidBuffering)
    {
        $avoidBuffer = new AvoidBuffer();
        if (!is_null($logLevelToAvoid)) {
            $avoidBuffer->addAvoidableLogLevel($logLevelToAvoid);
        }

        $this->assertEquals($expectedAvoidBuffering, $avoidBuffer->avoidBuffering($logLevel));
    }
}
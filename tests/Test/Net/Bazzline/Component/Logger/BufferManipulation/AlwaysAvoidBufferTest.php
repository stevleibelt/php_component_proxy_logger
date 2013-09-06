<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-09-06
 */

namespace Test\Net\Bazzline\Component\Logger\BufferManipulation;

use Net\Bazzline\Component\Logger\BufferManipulation\AlwaysAvoidBuffer;
use Psr\Log\LogLevel;
use Test\Net\Bazzline\Component\DataType\TestCase;

/**
 * Class AlwaysAvoidBufferTest
 *
 * @package Test\Net\Bazzline\Component\Logger\BufferManipulation
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-09-06
 */
class AlwaysAvoidBufferTest extends TestCase
{
    /**
     * @return array
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-09-06
     */
    public static function testCaseDataProvider()
    {
        return array(
            'no log level set no avoided' => array(
                'logLevel' => null,
                'logLevelToAvoid' => null,
                'expectedAvoidBuffering' => true
            ),
            'log level set but not avoided' => array(
                'logLevelToAdd' => LogLevel::INFO,
                'logLevelToAvoid' => null,
                'expectedAvoidBuffering' => true
            ),
            'log level set but different avoided' => array(
                'logLevelToAdd' => LogLevel::DEBUG,
                'logLevelToAvoid' => LogLevel::INFO,
                'expectedAvoidBuffering' => true
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
     * @since 2013-09-06
     */
    public function testAvoidBuffering($logLevel, $logLevelToAvoid, $expectedAvoidBuffering)
    {
        $avoidBuffer = new AlwaysAvoidBuffer();
        if (!is_null($logLevelToAvoid)) {
            $avoidBuffer->addAvoidableLogLevel($logLevelToAvoid);
        }

        $this->assertEquals($expectedAvoidBuffering, $avoidBuffer->avoidBuffering($logLevel));
    }
}

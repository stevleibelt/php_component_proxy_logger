<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-09-06
 */

namespace Test\Net\Bazzline\Component\Logger\BufferManipulation;

use Net\Bazzline\Component\Logger\BufferManipulation\AlwaysBypassBuffer;
use Psr\Log\LogLevel;
use Test\Net\Bazzline\Component\Logger\TestCase;

/**
 * Class AlwaysBypassBufferTest
 *
 * @package Test\Net\Bazzline\Component\Logger\BufferManipulation
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-09-06
 */
class AlwaysBypassBufferTest extends TestCase
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
                'logLevelToBypass' => null,
                'expectedBypassBufferValue' => true
            ),
            'log level set but not avoided' => array(
                'logLevelToAdd' => LogLevel::INFO,
                'logLevelToBypass' => null,
                'expectedBypassBufferValue' => true
            ),
            'log level set but different avoided' => array(
                'logLevelToAdd' => LogLevel::DEBUG,
                'logLevelToBypass' => LogLevel::INFO,
                'expectedBypassBufferValue' => true
            ),
            'log level set and same to avoid' => array(
                'logLevelToAdd' => LogLevel::INFO,
                'logLevelToBypass' => LogLevel::INFO,
                'expectedBypassBufferValue' => true
            )
        );
    }

    /**
     * @dataProvider testCaseDataProvider
     *
     * @param mixed $logLevel
     * @param mixed $logLevelToBypass
     * @param bool $expectedBypassBufferValue
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-09-06
     */
    public function testBypassBuffer($logLevel, $logLevelToBypass, $expectedBypassBufferValue)
    {
        $buffer = new AlwaysBypassBuffer();
        if (!is_null($logLevelToBypass)) {
            $buffer->addBypassForLogLevel($logLevelToBypass);
        }

        $this->assertEquals($expectedBypassBufferValue, $buffer->bypassBuffer($logLevel));
    }
}

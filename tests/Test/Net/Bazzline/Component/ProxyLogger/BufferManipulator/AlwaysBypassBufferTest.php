<?php
/**
 * @author stev leibelt <artodeto@bazzline.net>
 * @since 2013-09-06
 */

namespace Test\Net\Bazzline\Component\ProxyLogger\BufferManipulator;

use Net\Bazzline\Component\ProxyLogger\BufferManipulator\AlwaysBypassBuffer;
use Psr\Log\LogLevel;
use Test\Net\Bazzline\Component\ProxyLogger\TestCase;

/**
 * Class AlwaysBypassBufferTest
 *
 * @package Test\Net\Bazzline\Component\ProxyLogger\BufferManipulator
 * @author stev leibelt <artodeto@bazzline.net>
 * @since 2013-09-06
 */
class AlwaysBypassBufferTest extends TestCase
{
    /**
     * @return array
     * @author stev leibelt <artodeto@bazzline.net>
     * @since 2013-09-06
     */
    public static function testCaseDataProvider()
    {
        return array(
            'no log level set no bypass' => array(
                'logLevel' => null,
                'logLevelToBypass' => null,
                'expectedBypassBufferValue' => true
            ),
            'log level set but not bypass' => array(
                'logLevelToAdd' => LogLevel::INFO,
                'logLevelToBypass' => null,
                'expectedBypassBufferValue' => true
            ),
            'log level set but different bypass' => array(
                'logLevelToAdd' => LogLevel::DEBUG,
                'logLevelToBypass' => LogLevel::INFO,
                'expectedBypassBufferValue' => true
            ),
            'log level set and same to bypass' => array(
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
     * @author stev leibelt <artodeto@bazzline.net>
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

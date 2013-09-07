<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-09-05 
 */

namespace Test\Net\Bazzline\Component\Logger\BufferManipulation;

use Net\Bazzline\Component\Logger\BufferManipulation\BypassBuffer;
use Psr\Log\LogLevel;
use Test\Net\Bazzline\Component\Logger\TestCase;

/**
 * Class BypassBufferTest
 *
 * @package Test\Net\Bazzline\Component\Logger\BufferManipulation
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-09-05
 */
class BypassBufferTest extends TestCase
{
    /**
     * @return array
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-09-05
     */
    public static function testCaseDataProvider()
    {
        return array(
            'no log level set no bypass' => array(
                'logLevel' => null,
                'logLevelToBypass' => null,
                'expectedBypassBufferValue' => false
            ),
            'log level set but not bypass' => array(
                'logLevelToAdd' => LogLevel::INFO,
                'logLevelToBypass' => null,
                'expectedBypassBufferValue' => false
            ),
            'log level set but different bypass' => array(
                'logLevelToAdd' => LogLevel::DEBUG,
                'logLevelToBypass' => LogLevel::INFO,
                'expectedBypassBufferValue' => false
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
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-09-05
     */
    public function testBypassBuffer($logLevel, $logLevelToBypass, $expectedBypassBufferValue)
    {
        $avoidBuffer = $this->getNewBuffer();
        if (!is_null($logLevelToBypass)) {
            $avoidBuffer->addBypassForLogLevel($logLevelToBypass);
        }

        $this->assertEquals($expectedBypassBufferValue, $avoidBuffer->bypassBuffer($logLevel));
    }

    /**
     * @return array
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-09-07
     */
    public static function logLevelProvider()
    {
        return array(
            LogLevel::INFO,
            LogLevel::ALERT,
            LogLevel::NOTICE,
            LogLevel::CRITICAL,
            LogLevel::DEBUG,
            LogLevel::EMERGENCY,
            LogLevel::ERROR,
            LogLevel::WARNING
        );
    }

    /**
     * @dataProvider logLevelProvider
     *
     * @param mixed $logLevel
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-09-07
     */
    public function addBypassForLogLevelEmergency($logLevel)
    {
        $buffer = $this->getNewBuffer();
        $buffer->addBypassForLogLevelEmergency();

        if ($logLevel == LogLevel::EMERGENCY) {
            $this->assertTrue($buffer->bypassBuffer($logLevel));
        } else {
            $this->assertFalse($buffer->bypassBuffer($logLevel));
        }
    }

    /**
     * @dataProvider logLevelProvider
     *
     * @param mixed $logLevel
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-09-07
     */
    public function addBypassForLogLevelAlert($logLevel)
    {
        $buffer = $this->getNewBuffer();
        $buffer->addBypassForLogLevelAlert();

        if ($logLevel == LogLevel::ALERT) {
            $this->assertTrue($buffer->bypassBuffer($logLevel));
        } else {
            $this->assertFalse($buffer->bypassBuffer($logLevel));
        }
    }

    /**
     * @dataProvider logLevelProvider
     *
     * @param mixed $logLevel
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-09-07
     */
    public function addBypassForLogLevelCritical($logLevel)
    {
        $buffer = $this->getNewBuffer();
        $buffer->addBypassForLogLevelCritical();

        if ($logLevel == LogLevel::CRITICAL) {
            $this->assertTrue($buffer->bypassBuffer($logLevel));
        } else {
            $this->assertFalse($buffer->bypassBuffer($logLevel));
        }
    }

    /**
     * @dataProvider logLevelProvider
     *
     * @param mixed $logLevel
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-09-07
     */
    public function addBypassForLogLevelError($logLevel)
    {
        $buffer = $this->getNewBuffer();
        $buffer->addBypassForLogLevelError();

        if ($logLevel == LogLevel::ERROR) {
            $this->assertTrue($buffer->bypassBuffer($logLevel));
        } else {
            $this->assertFalse($buffer->bypassBuffer($logLevel));
        }
    }

    /**
     * @dataProvider logLevelProvider
     *
     * @param mixed $logLevel
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-09-07
     */
    public function addBypassForLogLevelWarning($logLevel)
    {
        $buffer = $this->getNewBuffer();
        $buffer->addBypassForLogLevelWarning();

        if ($logLevel == LogLevel::WARNING) {
            $this->assertTrue($buffer->bypassBuffer($logLevel));
        } else {
            $this->assertFalse($buffer->bypassBuffer($logLevel));
        }
    }

    /**
     * @dataProvider logLevelProvider
     *
     * @param mixed $logLevel
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-09-07
     */
    public function addBypassForLogLevelNotice($logLevel)
    {
        $buffer = $this->getNewBuffer();
        $buffer->addBypassForLevelNotice();

        if ($logLevel == LogLevel::NOTICE) {
            $this->assertTrue($buffer->bypassBuffer($logLevel));
        } else {
            $this->assertFalse($buffer->bypassBuffer($logLevel));
        }
    }

    /**
     * @dataProvider logLevelProvider
     *
     * @param mixed $logLevel
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-09-07
     */
    public function addBypassForLogLevelInfo($logLevel)
    {
        $buffer = $this->getNewBuffer();
        $buffer->addBypassForLogLevelInfo();

        if ($logLevel == LogLevel::INFO) {
            $this->assertTrue($buffer->bypassBuffer($logLevel));
        } else {
            $this->assertFalse($buffer->bypassBuffer($logLevel));
        }
    }

    /**
     * @dataProvider logLevelProvider
     *
     * @param mixed $logLevel
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-09-07
     */
    public function addBypassForLogLevelDebug($logLevel)
    {
        $buffer = $this->getNewBuffer();
        $buffer->addBypassForLogLevelDebug();

        if ($logLevel == LogLevel::DEBUG) {
            $this->assertTrue($buffer->bypassBuffer($logLevel));
        } else {
            $this->assertFalse($buffer->bypassBuffer($logLevel));
        }
    }

    /**
     * @return BypassBuffer
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-09-07
     */
    private function getNewBuffer()
    {
        return new BypassBuffer();
    }
}
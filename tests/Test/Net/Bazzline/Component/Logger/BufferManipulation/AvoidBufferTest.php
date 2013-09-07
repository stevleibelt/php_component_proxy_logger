<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-09-05 
 */

namespace Test\Net\Bazzline\Component\Logger\BufferManipulation;

use Net\Bazzline\Component\Logger\BufferManipulation\AvoidBuffer;
use Psr\Log\LogLevel;
use Test\Net\Bazzline\Component\Logger\TestCase;

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
        $avoidBuffer = $this->getNewAvoidBuffer();
        if (!is_null($logLevelToAvoid)) {
            $avoidBuffer->addBypassForLogLevel($logLevelToAvoid);
        }

        $this->assertEquals($expectedAvoidBuffering, $avoidBuffer->bypassBuffer($logLevel));
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
    public function addAvoidableEmergencyLogLevel($logLevel)
    {
        $avoidBuffer = $this->getNewAvoidBuffer();
        $avoidBuffer->addBypassForLogLevelEmergency();

        if ($logLevel == LogLevel::EMERGENCY) {
            $this->assertTrue($avoidBuffer->bypassBuffer($logLevel));
        } else {
            $this->assertFalse($avoidBuffer->bypassBuffer($logLevel));
        }
    }

    /**
     * @dataProvider logLevelProvider
     *
     * @param mixed $logLevel
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-09-07
     */
    public function addAvoidableAlertLogLevel($logLevel)
    {
        $avoidBuffer = $this->getNewAvoidBuffer();
        $avoidBuffer->addBypassForLogLevelAlert();

        if ($logLevel == LogLevel::ALERT) {
            $this->assertTrue($avoidBuffer->bypassBuffer($logLevel));
        } else {
            $this->assertFalse($avoidBuffer->bypassBuffer($logLevel));
        }
    }

    /**
     * @dataProvider logLevelProvider
     *
     * @param mixed $logLevel
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-09-07
     */
    public function addAvoidableCriticalLogLevel($logLevel)
    {
        $avoidBuffer = $this->getNewAvoidBuffer();
        $avoidBuffer->addBypassForLogLevelCritical();

        if ($logLevel == LogLevel::CRITICAL) {
            $this->assertTrue($avoidBuffer->bypassBuffer($logLevel));
        } else {
            $this->assertFalse($avoidBuffer->bypassBuffer($logLevel));
        }
    }

    /**
     * @dataProvider logLevelProvider
     *
     * @param mixed $logLevel
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-09-07
     */
    public function addAvoidableErrorLogLevel($logLevel)
    {
        $avoidBuffer = $this->getNewAvoidBuffer();
        $avoidBuffer->addBypassForLogLevelError();

        if ($logLevel == LogLevel::ERROR) {
            $this->assertTrue($avoidBuffer->bypassBuffer($logLevel));
        } else {
            $this->assertFalse($avoidBuffer->bypassBuffer($logLevel));
        }
    }

    /**
     * @dataProvider logLevelProvider
     *
     * @param mixed $logLevel
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-09-07
     */
    public function addAvoidableWarningLogLevel($logLevel)
    {
        $avoidBuffer = $this->getNewAvoidBuffer();
        $avoidBuffer->addBypassForLogLevelWarning();

        if ($logLevel == LogLevel::WARNING) {
            $this->assertTrue($avoidBuffer->bypassBuffer($logLevel));
        } else {
            $this->assertFalse($avoidBuffer->bypassBuffer($logLevel));
        }
    }

    /**
     * @dataProvider logLevelProvider
     *
     * @param mixed $logLevel
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-09-07
     */
    public function addAvoidableNoticeLogLevel($logLevel)
    {
        $avoidBuffer = $this->getNewAvoidBuffer();
        $avoidBuffer->addBypassForLevelNotice();

        if ($logLevel == LogLevel::NOTICE) {
            $this->assertTrue($avoidBuffer->bypassBuffer($logLevel));
        } else {
            $this->assertFalse($avoidBuffer->bypassBuffer($logLevel));
        }
    }

    /**
     * @dataProvider logLevelProvider
     *
     * @param mixed $logLevel
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-09-07
     */
    public function addAvoidableInfoLogLevel($logLevel)
    {
        $avoidBuffer = $this->getNewAvoidBuffer();
        $avoidBuffer->addBypassForLogLevelInfo();

        if ($logLevel == LogLevel::INFO) {
            $this->assertTrue($avoidBuffer->bypassBuffer($logLevel));
        } else {
            $this->assertFalse($avoidBuffer->bypassBuffer($logLevel));
        }
    }

    /**
     * @dataProvider logLevelProvider
     *
     * @param mixed $logLevel
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-09-07
     */
    public function addAvoidableDebugLogLevel($logLevel)
    {
        $avoidBuffer = $this->getNewAvoidBuffer();
        $avoidBuffer->addBypassForLogLevelDebug();

        if ($logLevel == LogLevel::DEBUG) {
            $this->assertTrue($avoidBuffer->bypassBuffer($logLevel));
        } else {
            $this->assertFalse($avoidBuffer->bypassBuffer($logLevel));
        }
    }

    /**
     * @return AvoidBuffer
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-09-07
     */
    private function getNewAvoidBuffer()
    {
        return new AvoidBuffer();
    }
}
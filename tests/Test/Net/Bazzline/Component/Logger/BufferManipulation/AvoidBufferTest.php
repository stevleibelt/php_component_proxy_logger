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
            'no log level set' => array(
                'logLevelToAdd' => null,
                'logLevelToTest' => LogLevel::ALERT,
                'expectedAvoidBuffering' => false
            )
        );
    }

    /**
     * @dataProvider testCaseDataProvider
     *
     * @param mixed $logLevelToAdd
     * @param mixed $logLevelToTest
     * @param bool $expectedAvoidBuffering
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-09-05
     */
    public function testAvoidBuffering($logLevelToAdd, $logLevelToTest, $expectedAvoidBuffering)
    {
        $avoidBuffer = new AvoidBuffer();
        if (!is_null($logLevelToAdd)) {
            $avoidBuffer->addAvoidableLogLevel($logLevelToAdd);
        }

        $this->assertEquals($expectedAvoidBuffering, $avoidBuffer->avoidBuffering($logLevelToTest));
    }
}
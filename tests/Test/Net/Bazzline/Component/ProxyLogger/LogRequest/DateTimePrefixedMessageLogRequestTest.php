<?php
/**
 * @author stev leibelt <artodeto@bazzline.net>
 * @since 2013-08-27
 */

namespace Test\Net\Bazzline\Component\ProxyLogger\LogRequest;

use Net\Bazzline\Component\ProxyLogger\LogRequest\DateTimePrefixedMessageLogRequest;
use Psr\Log\LogLevel;
use Test\Net\Bazzline\Component\ProxyLogger\TestCase;

/**
 * Class DateTimePrefixedMessageLogRequestTest
 *
 * @package Test\Net\Bazzline\Component\ProxyLogger
 * @author stev leibelt <artodeto@bazzline.net>
 * @since 2013-08-27
 */
class DateTimePrefixedMessageLogRequestTest extends TestCase
{
    /**
     * @author stev leibelt <artodeto@bazzline.net>
     * @since 2013-08-27
     */
    public function testGetLevel()
    {
        $level = LogLevel::ALERT;
        $message = 'test';
        $request = new DateTimePrefixedMessageLogRequest($level, $message);

        $this->assertEquals($level, $request->getLevel());
    }

    /**
     * @author stev leibelt <artodeto@bazzline.net>
     * @since 2013-08-27
     */
    public function testGetMessage()
    {
        $level = LogLevel::ALERT;
        $message = 'test';
        $request = new DateTimePrefixedMessageLogRequest($level, $message);

        $this->assertEquals($this->getPrefixedMessage($message), $request->getMessage());
    }

    /**
     * @author stev leibelt <artodeto@bazzline.net>
     * @since 2013-08-27
     */
    public function testGetContext()
    {
        $level = LogLevel::ALERT;
        $message = 'test';
        $request = new DateTimePrefixedMessageLogRequest($level, $message);

        $this->assertEquals(array(), $request->getContext());
    }

    /**
     * @param $message
     * @return string
     * @author stev leibelt <artodeto@bazzline.net>
     * @since 2013-08-29
     */
    private function getPrefixedMessage($message)
    {
        return date('Y-m-d H:i:s') . '] [' . $message;
    }
}
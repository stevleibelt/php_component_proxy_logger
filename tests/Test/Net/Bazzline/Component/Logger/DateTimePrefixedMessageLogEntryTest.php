<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-08-27
 */

namespace Test\Net\Bazzline\Component\Logger;

use Net\Bazzline\Component\Logger\DateTimePrefixedMessageLogEntry;
use Psr\Log\LogLevel;

/**
 * Class DateTimePrefixedMessageLogEntryTest
 *
 * @package Test\Net\Bazzline\Component\Logger
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-08-27
 */
class DateTimePrefixedMessageLogEntryTest extends TestCase
{
    /**
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-27
     */
    public function testGetLevel()
    {
        $level = LogLevel::ALERT;
        $message = 'test';
        $entry = new DateTimePrefixedMessageLogEntry($level, $message);

        $this->assertEquals($level, $entry->getLevel());
    }

    /**
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-27
     */
    public function testGetMessage()
    {
        $level = LogLevel::ALERT;
        $message = 'test';
        $entry = new DateTimePrefixedMessageLogEntry($level, $message);

        $this->assertEquals($this->getPrefixedMessage($message), $entry->getMessage());
    }

    /**
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-27
     */
    public function testGetContext()
    {
        $level = LogLevel::ALERT;
        $message = 'test';
        $entry = new DateTimePrefixedMessageLogEntry($level, $message);

        $this->assertEquals(array(), $entry->getContext());
    }

    /**
     * @param $message
     * @return string
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-29
     */
    private function getPrefixedMessage($message)
    {
        return date('Y-m-d H:i:s') . '] [' . $message;
    }
}
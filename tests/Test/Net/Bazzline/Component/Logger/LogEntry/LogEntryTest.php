<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-08-27
 */

namespace Test\Net\Bazzline\Component\Logger\LogEntry;

use Net\Bazzline\Component\Logger\LogEntry\LogEntry;
use Psr\Log\LogLevel;
use Test\Net\Bazzline\Component\Logger\TestCase;

/**
 * Class LogEntryTest
 *
 * @package Test\Net\Bazzline\Component\Logger
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-08-27
 */
class LogEntryTest extends TestCase
{
    /**
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-27
     */
    public function testGetLevel()
    {
        $level = LogLevel::ALERT;
        $message = 'test';
        $entry = new LogEntry($level, $message);

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
        $entry = new LogEntry($level, $message);

        $this->assertEquals($message, $entry->getMessage());
    }

    /**
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-27
     */
    public function testGetContext()
    {
        $level = LogLevel::ALERT;
        $message = 'test';
        $entry = new LogEntry($level, $message);

        $this->assertEquals(array(), $entry->getContext());
    }
}
<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-08-27
 */

namespace Test\Net\Bazzline\Component\Logger\LogEntry;

use Net\Bazzline\Component\Logger\LogEntry\LogEntryFactory;
use Psr\Log\LogLevel;
use Test\Net\Bazzline\Component\Logger\TestCase;

/**
 * Class LogEntryFactoryTest
 *
 * @package Test\Net\Bazzline\Component\Logger\LogEntry
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-08-27
 */
class LogEntryFactoryTest extends TestCase
{
    /**
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-27
     */
    public function testCreateWithLogEntry()
    {
        $factory = new LogEntryFactory();
        $level = LogLevel::ALERT;
        $message = 'the message is love';
        $factory->setLogEntryClassName('LogEntry');
        $entry = $factory->create($level, $message);

        $this->assertInstanceOf('Net\Bazzline\Component\Logger\LogEntry\LogEntryInterface', $entry);
        $this->assertEquals($level, $entry->getLevel());
        $this->assertEquals($message, $entry->getMessage());
        $this->assertEquals(array(), $entry->getContext());
    }

    /**
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-29
     */
    public function testCreateWithDateTimePrefixedMessageLogEntry()
    {
        $factory = new LogEntryFactory();
        $level = LogLevel::ALERT;
        $message = 'the message is love';
        $factory->setLogEntryClassName('DateTimePrefixedMessageLogEntry');
        $entry = $factory->create($level, $message);

        $this->assertInstanceOf('Net\Bazzline\Component\Logger\LogEntry\LogEntryInterface', $entry);
        $this->assertEquals($level, $entry->getLevel());
        $this->assertEquals($this->getPrefixedMessage($message), $entry->getMessage());
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
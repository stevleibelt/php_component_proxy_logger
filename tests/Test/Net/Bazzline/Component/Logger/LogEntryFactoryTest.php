<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-08-27
 */

namespace Test\Net\Bazzline\Component\Logger;

use Net\Bazzline\Component\Logger\LogEntryFactory;
use Psr\Log\LogLevel;

/**
 * Class LogEntryFactoryTest
 *
 * @package Test\Net\Bazzline\Component\Logger
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-08-27
 */
class LogEntryFactoryTest extends TestCase
{
    /**
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-27
     */
    public function testCreate()
    {
        $factory = new LogEntryFactory();
        $level = LogLevel::ALERT;
        $message = 'the message is love';
        $entry = $factory->create($level, $message);

        $this->assertInstanceOf('Net\Bazzline\Component\Logger\LogEntry', $entry);
        $this->assertEquals($level, $entry->getLevel());
        $this->assertEquals($message, $entry->getMessage());
        $this->assertEquals(array(), $entry->getContext());
    }
}
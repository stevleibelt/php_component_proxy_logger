<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-08-27 
 */

namespace Test\Net\Bazzline\Component\Logger\Factory;

use Net\Bazzline\Component\Logger\Factory\LogEntryRuntimeBufferFactory;
use Test\Net\Bazzline\Component\Logger\TestCase;

/**
 * Class LogEntryRuntimeBufferFactoryTest
 *
 * @package Test\Net\Bazzline\Component\Logger
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-08-27
 */
class LogEntryRuntimeBufferFactoryTest extends TestCase
{
    /**
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-27
     */
    public function testCreate()
    {
        $factory = new LogEntryRuntimeBufferFactory();
        $buffer = $factory->create();

        $this->assertInstanceOf('Net\Bazzline\Component\Logger\LogEntry\LogEntryBufferInterface', $buffer);
        $this->assertInstanceOf('Net\Bazzline\Component\Logger\LogEntry\LogEntryRuntimeBuffer', $buffer);
        $this->assertEquals(0, $buffer->count());
    }
}
<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-08-27 
 */

namespace Test\Net\Bazzline\Component\Logger;

use Net\Bazzline\Component\Logger\LogEntryRuntimeBufferFactory;

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

        $this->assertInstanceOf('Net\Bazzline\Component\Logger\LogEntryBufferInterface', $buffer);
        $this->assertInstanceOf('Net\Bazzline\Component\Logger\LogEntryRuntimeBuffer', $buffer);
        $this->assertEquals(0, $buffer->count());
    }
}
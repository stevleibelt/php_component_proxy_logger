<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-08-27 
 */

namespace Test\Net\Bazzline\Component\Logger\Factory;

use Net\Bazzline\Component\Logger\Factory\LogRequestRuntimeBufferFactory;
use Test\Net\Bazzline\Component\Logger\TestCase;

/**
 * Class LogRequestRuntimeBufferFactoryTest
 *
 * @package Test\Net\Bazzline\Component\Logger
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-08-27
 */
class LogRequestRuntimeBufferFactoryTest extends TestCase
{
    /**
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-27
     */
    public function testCreate()
    {
        $factory = new LogRequestRuntimeBufferFactory();
        $buffer = $factory->create();

        $this->assertInstanceOf('Net\Bazzline\Component\Logger\LogRequest\LogRequestBufferInterface', $buffer);
        $this->assertInstanceOf('Net\Bazzline\Component\Logger\LogRequest\LogRequestRuntimeBuffer', $buffer);
        $this->assertEquals(0, $buffer->count());
    }
}
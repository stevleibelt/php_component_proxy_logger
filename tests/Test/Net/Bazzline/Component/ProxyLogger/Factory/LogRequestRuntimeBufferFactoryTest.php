<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-08-27 
 */

namespace Test\Net\Bazzline\Component\ProxyLogger\Factory;

use Net\Bazzline\Component\ProxyLogger\Factory\LogRequestRuntimeBufferFactory;
use Test\Net\Bazzline\Component\ProxyLogger\TestCase;

/**
 * Class LogRequestRuntimeBufferFactoryTest
 *
 * @package Test\Net\Bazzline\Component\ProxyLogger
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

        $this->assertInstanceOf('Net\Bazzline\Component\ProxyLogger\LogRequest\LogRequestBufferInterface', $buffer);
        $this->assertInstanceOf('Net\Bazzline\Component\ProxyLogger\LogRequest\LogRequestRuntimeBuffer', $buffer);
        $this->assertEquals(0, $buffer->count());
    }
}
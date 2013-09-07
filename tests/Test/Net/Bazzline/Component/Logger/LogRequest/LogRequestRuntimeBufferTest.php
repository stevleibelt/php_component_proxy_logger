<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-08-26
 */

namespace Test\Net\Bazzline\Component\Logger\LogRequest;

use Net\Bazzline\Component\Logger\LogRequest\LogRequestRuntimeBuffer;
use Mockery;
use Test\Net\Bazzline\Component\Logger\TestCase;

/**
 * Class LogRequestRuntimeBufferTest
 *
 * @package Test\Net\Bazzline\Component\Logger\LogRequest
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-08-26
 */
class LogRequestRuntimeBufferTest extends TestCase
{
    /**
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-27
     */
    public function testCreation()
    {
        $collection = $this->getNewBuffer();
        $request = $this->getLogRequest();

        $this->assertEquals(0, $collection->count());
        $this->assertFalse($collection->contains($request));
    }

    /**
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-26
     */
    public function testAttach()
    {
        $buffer = $this->getNewBuffer();
        $buffer->attach($this->getLogRequest());

        $this->assertEquals(1, $buffer->count());
    }

    /**
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-26
     */
    public function testContains()
    {
        $buffer = $this->getNewBuffer();
        $request = $this->getLogRequest();
        $buffer->attach($request);

        $this->assertTrue($buffer->contains($request));
    }

    /**
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-26
     */
    public function testDetach()
    {
        $buffer = $this->getNewBuffer();
        $request = $this->getLogRequest();
        //no error expected when detaching a not attached request
        $buffer->detach($request);
        //now attach and detach request
        $buffer->attach($request);
        $buffer->detach($request);

        $this->assertEquals(0, $buffer->count());
    }

    /**
     * @return LogRequestRuntimeBuffer
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-26
     */
    private function getNewBuffer()
    {
        return new LogRequestRuntimeBuffer;
    }
}
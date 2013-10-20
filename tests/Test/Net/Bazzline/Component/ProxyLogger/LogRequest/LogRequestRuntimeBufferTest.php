<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-08-26
 */

namespace Test\Net\Bazzline\Component\ProxyLogger\LogRequest;

use Net\Bazzline\Component\ProxyLogger\LogRequest\LogRequestRuntimeBuffer;
use Mockery;
use Test\Net\Bazzline\Component\ProxyLogger\TestCase;

/**
 * Class LogRequestRuntimeBufferTest
 *
 * @package Test\Net\Bazzline\Component\ProxyLogger\LogRequest
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
        $request = $this->getNewLogRequestMock();

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
        $buffer->attach($this->getNewLogRequestMock());

        $this->assertEquals(1, $buffer->count());
    }

    /**
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-26
     */
    public function testContains()
    {
        $buffer = $this->getNewBuffer();
        $request = $this->getNewLogRequestMock();
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
        $request = $this->getNewLogRequestMock();
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
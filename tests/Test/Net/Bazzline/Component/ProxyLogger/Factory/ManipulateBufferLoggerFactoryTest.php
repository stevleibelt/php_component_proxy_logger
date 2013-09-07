<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-08-28 
 */

namespace Test\Net\Bazzline\Component\ProxyLogger\Factory;

use Net\Bazzline\Component\ProxyLogger\Factory\ManipulateBufferLoggerFactory;
use Test\Net\Bazzline\Component\ProxyLogger\TestCase;

/**
 * Class ManipulateBufferLoggerFactoryTest
 *
 * @package Test\Net\Bazzline\Component\ProxyLogger
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-08-28
 */
class ManipulateBufferLoggerFactoryTest extends TestCase
{
    /**
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-28
     */
    public function testCreateWithoutFlushBufferTriggerAndWithoutAvoidBuffer()
    {
        $factory = new ManipulateBufferLoggerFactory();
        $logger = $this->getPsr3Logger();

        $buffer = $factory->create($logger);

        $this->assertInstanceOf('Net\Bazzline\Component\Logger\Proxy\ManipulateBufferLoggerInterface', $buffer);
        $this->assertInstanceOf('Net\Bazzline\Component\Logger\Proxy\ManipulateBufferLogger', $buffer);
        $this->assertFalse($buffer->hasFlushBufferTrigger());
        $this->assertFalse($buffer->hasBypassBuffer());
    }

    /**
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-09-06
     */
    public function testCreateWithFlushBufferTriggerAndWithoutAvoidBuffer()
    {
        $factory = new ManipulateBufferLoggerFactory();
        $logger = $this->getPsr3Logger();
        $flushBufferTrigger = $this->getNewAbstractFlushBufferTrigger();

        $buffer = $factory->create($logger, $flushBufferTrigger);

        $this->assertInstanceOf('Net\Bazzline\Component\Logger\Proxy\ManipulateBufferLoggerInterface', $buffer);
        $this->assertInstanceOf('Net\Bazzline\Component\Logger\Proxy\ManipulateBufferLogger', $buffer);
        $this->assertTrue($buffer->hasFlushBufferTrigger());
        $this->assertFalse($buffer->hasBypassBuffer());
    }

    /**
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-09-06
     */
    public function testCreateWithoutFlushBufferTriggerAndWithAvoidBuffer()
    {
        $factory = new ManipulateBufferLoggerFactory();
        $logger = $this->getPsr3Logger();
        $bypassBuffer = $this->getBypassBuffer();

        $buffer = $factory->create($logger, null, $bypassBuffer);

        $this->assertInstanceOf('Net\Bazzline\Component\Logger\Proxy\ManipulateBufferLoggerInterface', $buffer);
        $this->assertInstanceOf('Net\Bazzline\Component\Logger\Proxy\ManipulateBufferLogger', $buffer);
        $this->assertFalse($buffer->hasFlushBufferTrigger());
        $this->assertTrue($buffer->hasBypassBuffer());
    }

    /**
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-09-06
     */
    public function testCreateWithFlushBufferTriggerAndWithAvoidBuffer()
    {
        $factory = new ManipulateBufferLoggerFactory();
        $logger = $this->getPsr3Logger();
        $flushBufferTrigger = $this->getNewAbstractFlushBufferTrigger();
        $bypassBuffer = $this->getBypassBuffer();

        $buffer = $factory->create($logger, $flushBufferTrigger, $bypassBuffer);

        $this->assertInstanceOf('Net\Bazzline\Component\Logger\Proxy\ManipulateBufferLoggerInterface', $buffer);
        $this->assertInstanceOf('Net\Bazzline\Component\Logger\Proxy\ManipulateBufferLogger', $buffer);
        $this->assertTrue($buffer->hasFlushBufferTrigger());
        $this->assertTrue($buffer->hasBypassBuffer());
    }
}
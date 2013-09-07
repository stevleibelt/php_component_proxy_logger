<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-08-28 
 */

namespace Test\Net\Bazzline\Component\Logger\Factory;

use Net\Bazzline\Component\Logger\Factory\ManipulateBufferLoggerFactory;
use Test\Net\Bazzline\Component\Logger\TestCase;

/**
 * Class ManipulateBufferLoggerFactoryTest
 *
 * @package Test\Net\Bazzline\Component\Logger
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
        $this->assertFalse($buffer->hasAvoidBuffer());
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
        $this->assertFalse($buffer->hasAvoidBuffer());
    }

    /**
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-09-06
     */
    public function testCreateWithoutFlushBufferTriggerAndWithAvoidBuffer()
    {
        $factory = new ManipulateBufferLoggerFactory();
        $logger = $this->getPsr3Logger();
        $avoidBuffer = $this->getAvoidBuffer();

        $buffer = $factory->create($logger, null, $avoidBuffer);

        $this->assertInstanceOf('Net\Bazzline\Component\Logger\Proxy\ManipulateBufferLoggerInterface', $buffer);
        $this->assertInstanceOf('Net\Bazzline\Component\Logger\Proxy\ManipulateBufferLogger', $buffer);
        $this->assertFalse($buffer->hasFlushBufferTrigger());
        $this->assertTrue($buffer->hasAvoidBuffer());
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
        $avoidBuffer = $this->getAvoidBuffer();

        $buffer = $factory->create($logger, $flushBufferTrigger, $avoidBuffer);

        $this->assertInstanceOf('Net\Bazzline\Component\Logger\Proxy\ManipulateBufferLoggerInterface', $buffer);
        $this->assertInstanceOf('Net\Bazzline\Component\Logger\Proxy\ManipulateBufferLogger', $buffer);
        $this->assertTrue($buffer->hasFlushBufferTrigger());
        $this->assertTrue($buffer->hasAvoidBuffer());
    }
}
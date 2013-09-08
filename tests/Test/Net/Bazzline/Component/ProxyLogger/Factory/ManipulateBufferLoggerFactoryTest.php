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

        $manipulateBufferLogger = $factory->create($logger);

        $this->assertInstanceOf('Net\Bazzline\Component\ProxyLogger\Proxy\ManipulateBufferLoggerInterface', $manipulateBufferLogger);
        $this->assertInstanceOf('Net\Bazzline\Component\ProxyLogger\Proxy\ManipulateBufferLogger', $manipulateBufferLogger);
        $this->assertFalse($manipulateBufferLogger->hasFlushBufferTrigger());
        $this->assertFalse($manipulateBufferLogger->hasBypassBuffer());
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

        $manipulateBufferLogger = $factory->create($logger, $flushBufferTrigger);

        $this->assertInstanceOf('Net\Bazzline\Component\ProxyLogger\Proxy\ManipulateBufferLoggerInterface', $manipulateBufferLogger);
        $this->assertInstanceOf('Net\Bazzline\Component\ProxyLogger\Proxy\ManipulateBufferLogger', $manipulateBufferLogger);
        $this->assertTrue($manipulateBufferLogger->hasFlushBufferTrigger());
        $this->assertFalse($manipulateBufferLogger->hasBypassBuffer());
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

        $manipulateBufferLogger = $factory->create($logger, null, $bypassBuffer);

        $this->assertInstanceOf('Net\Bazzline\Component\ProxyLogger\Proxy\ManipulateBufferLoggerInterface', $manipulateBufferLogger);
        $this->assertInstanceOf('Net\Bazzline\Component\ProxyLogger\Proxy\ManipulateBufferLogger', $manipulateBufferLogger);
        $this->assertFalse($manipulateBufferLogger->hasFlushBufferTrigger());
        $this->assertTrue($manipulateBufferLogger->hasBypassBuffer());
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

        $manipulateBufferLogger = $factory->create($logger, $flushBufferTrigger, $bypassBuffer);

        $this->assertInstanceOf('Net\Bazzline\Component\ProxyLogger\Proxy\ManipulateBufferLoggerInterface', $manipulateBufferLogger);
        $this->assertInstanceOf('Net\Bazzline\Component\ProxyLogger\Proxy\ManipulateBufferLogger', $manipulateBufferLogger);
        $this->assertTrue($manipulateBufferLogger->hasFlushBufferTrigger());
        $this->assertTrue($manipulateBufferLogger->hasBypassBuffer());
    }
}
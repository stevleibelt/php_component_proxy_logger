<?php
/**
 * @author stev leibelt <artodeto@bazzline.net>
 * @since 2013-11-01 
 */

namespace Test\Net\Bazzline\Component\ProxyLogger\Factory;

use Net\Bazzline\Component\ProxyLogger\Factory\DefaultManipulateBufferLoggerFactory;
use Net\Bazzline\Component\ProxyLogger\Factory\UpwardFlushBufferTriggerFactory;
use Test\Net\Bazzline\Component\ProxyLogger\TestCase;

/**
 * Class DefaultManipulateBufferLoggerFactoryTest
 *
 * @package Test\Net\Bazzline\Component\ProxyLogger\Factory
 * @author stev leibelt <artodeto@bazzline.net>
 * @since 2013-11-01
 */
class DefaultManipulateBufferLoggerFactoryTest extends TestCase
{
    /**
     * @author stev leibelt <artodeto@bazzline.net>
     * @since 2013-11-01
     */
    public function testCreate()
    {
        $factory = new DefaultManipulateBufferLoggerFactory();
        $realLogger = $this->getNewPsr3LoggerMock();
        $realLogger->shouldReceive('log')
            ->with('info', 'test message', array())
            ->once();
        $realLogger->shouldReceive('log')
            ->with('error', 'test message', array())
            ->once();

        $logger = $factory->create($realLogger);
        $logger->getEvent()
            ->getFlushBufferTrigger()
            ->setTriggerToError();
        $logger->info('test message');
        $logger->error('test message');

        $this->assertTrue($logger->getEvent()->hasBypassBuffer());
        $this->assertTrue($logger->getEvent()->hasFlushBufferTrigger());
        $this->assertInstanceOf('Net\Bazzline\Component\ProxyLogger\Logger\BufferLoggerInterface', $logger);
        $this->assertInstanceOf('Net\Bazzline\Component\ProxyLogger\Logger\BufferLogger', $logger);
    }
}
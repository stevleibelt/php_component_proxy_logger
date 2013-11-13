<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-11-01 
 */

namespace Test\Net\Bazzline\Component\ProxyLogger\Factory;

use Net\Bazzline\Component\ProxyLogger\Factory\DefaultManipulateBufferLoggerFactory;
use Test\Net\Bazzline\Component\ProxyLogger\TestCase;

/**
 * Class DefaultManipulateBufferLoggerFactoryTest
 *
 * @package Test\Net\Bazzline\Component\ProxyLogger\Factory
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-11-01
 */
class DefaultManipulateBufferLoggerFactoryTest extends TestCase
{
    /**
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-11-01
     */
    public function testCreate()
    {
        $factory = new DefaultManipulateBufferLoggerFactory();
        $logger = $this->getNewPsr3LoggerMock();
        $logger->shouldReceive('log')
            ->with('info', 'test message', array())
            ->once();
        $logger->shouldReceive('log')
            ->with('error', 'test message', array())
            ->once();

        $bufferLogger = $factory->create($logger);
        $bufferLogger->getFlushBufferTrigger()
            ->setTriggerToError();
        $bufferLogger->info('test message');
        $bufferLogger->error('test message');

        $this->assertTrue($bufferLogger->hasBypassBuffer());
        $this->assertTrue($bufferLogger->hasFlushBufferTrigger());
        $this->assertInstanceOf('Net\Bazzline\Component\ProxyLogger\Logger\ManipulateBufferLoggerInterface', $bufferLogger);
        $this->assertInstanceOf('Net\Bazzline\Component\ProxyLogger\Logger\ManipulateBufferLogger', $bufferLogger);
    }
}
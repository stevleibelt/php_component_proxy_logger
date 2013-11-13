<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-10-26
 */

namespace Test\Net\Bazzline\Component\ProxyLogger\Factory;

use Net\Bazzline\Component\ProxyLogger\Proxy\OutputToConsoleLogger;
use Net\Bazzline\Component\ProxyLogger\Factory\DefaultBufferLoggerFactory;
use Test\Net\Bazzline\Component\ProxyLogger\TestCase;

/**
 * Class DefaultBufferLoggerFactoryTest
 *
 * @package Test\Net\Bazzline\Component\ProxyLogger\Factory
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-10-26
 */
class DefaultBufferLoggerFactoryTest extends TestCase
{
    /**
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-10-26
     */
    public function testCreate()
    {
        $factory = new DefaultBufferLoggerFactory();
        $logger = $this->getNewPsr3LoggerMock();
        $logger->shouldReceive('log')
            ->with('info', 'test message', array())
            ->once();

        $bufferLogger = $factory->create($logger);
        $bufferLogger->info('test message');
        $bufferLogger->flush();

        $this->assertInstanceOf('Net\Bazzline\Component\ProxyLogger\Proxy\BufferLoggerInterface', $bufferLogger);
        $this->assertInstanceOf('Net\Bazzline\Component\ProxyLogger\Proxy\BufferLogger', $bufferLogger);
    }
} 
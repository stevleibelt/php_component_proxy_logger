<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-10-26
 */

namespace Test\Net\Bazzline\Component\ProxyLogger\Factory;

use Net\Bazzline\Component\ProxyLogger\Logger\OutputToConsoleLogger;
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
        $realLogger = $this->getNewPsr3LoggerMock();
        $realLogger->shouldReceive('log')
            ->with('info', 'test message', array())
            ->once();

        $logger = $factory->create($realLogger);
        $logger->info('test message');
        $logger->flush();

        $this->assertInstanceOf('Net\Bazzline\Component\ProxyLogger\Logger\BufferLoggerInterface', $logger);
        $this->assertInstanceOf('Net\Bazzline\Component\ProxyLogger\Logger\BufferLogger', $logger);
    }
} 
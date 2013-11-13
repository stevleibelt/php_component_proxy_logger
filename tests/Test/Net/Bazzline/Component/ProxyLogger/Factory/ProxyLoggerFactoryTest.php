<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-09-08 
 */

namespace Test\Net\Bazzline\Component\ProxyLogger\Factory;

use Net\Bazzline\Component\ProxyLogger\Factory\ProxyLoggerFactory;
use Test\Net\Bazzline\Component\ProxyLogger\TestCase;

/**
 * Class ProxyLoggerFactoryTest
 *
 * @package Test\Net\Bazzline\Component\ProxyLogger\Factory
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-09-08
 */
class ProxyLoggerFactoryTest extends TestCase
{
    /**
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-09-08
     */
    public function testCreate()
    {
        $proxyLoggerFactory = new  ProxyLoggerFactory();
        $realLogger = $this->getNewPsr3LoggerMock();
        $proxyLogger = $proxyLoggerFactory->create($realLogger);

        $this->assertInstanceOf('Net\Bazzline\Component\ProxyLogger\Logger\ProxyLoggerInterface', $proxyLogger);
        $this->assertInstanceOf('Net\Bazzline\Component\ProxyLogger\Logger\ProxyLogger', $proxyLogger);
    }
}
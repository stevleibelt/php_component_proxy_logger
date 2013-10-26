<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-10-26
 */

namespace Test\Net\Bazzline\Component\ProxyLogger\Factory;

use Net\Bazzline\Component\ProxyLogger\Factory\DefaultBufferLoggerFactory;
use Test\Net\Bazzline\Component\ProxyLogger\TestCase;

class DefaultBufferLoggerFactoryTest extends TestCase
{
    public function testNew()
    {
        $factory = new DefaultBufferLoggerFactory();
        $logger = $factory->create($this->getNewPsr3LoggerMock());

        //test that logger mock gets expected method calls
        //$this->assertTrue($logger->)
    }
} 
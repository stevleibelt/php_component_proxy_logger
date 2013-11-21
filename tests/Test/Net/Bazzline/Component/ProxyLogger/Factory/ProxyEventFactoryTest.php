<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-11-18 
 */

namespace Test\Net\Bazzline\Component\ProxyLogger\Factory;

use Net\Bazzline\Component\ProxyLogger\Factory\ProxyEventFactory;
use Test\Net\Bazzline\Component\ProxyLogger\TestCase;

/**
 * Class ProxyEventFactoryTest
 * @package Test\Net\Bazzline\Component\ProxyLogger\Factory
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-11-18
 */
class ProxyEventFactoryTest extends TestCase
{
    /**
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-11-18
     * @todo create testcases
     *  - (loggerCollection^!logRequest)
     *  - (!loggerCollection^logRequest)
     *  - (loggerCollection^logRequest)
     */
    public function testCreate()
    {
        $factory = new ProxyEventFactory();
        $event = $factory->create();

        $this->assertSame(array(), $event->getLoggerCollection());
        $this->assertNull($event->getLogRequest());
    }
} 
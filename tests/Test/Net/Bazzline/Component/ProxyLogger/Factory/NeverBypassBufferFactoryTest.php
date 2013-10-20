<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-10-20
 */

namespace Test\Net\Bazzline\Component\ProxyLogger\Factory;

use Net\Bazzline\Component\ProxyLogger\BufferManipulator\NeverBypassBuffer;
use Test\Net\Bazzline\Component\ProxyLogger\TestCase;
use Net\Bazzline\Component\ProxyLogger\Factory\NeverBypassBufferFactory;

/**
 * Class NeverBypassBufferFactoryTest
 *
 * @package Test\Net\Bazzline\Component\ProxyLogger\Factory
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-10-20
 */
class NeverBypassBufferFactoryTest extends TestCase
{
    /**
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-10-20
     */
    public function testCreate()
    {
        $factory = $this->getNewFactory();
        $bypassBuffer = $factory->create();

        $this->assertTrue($bypassBuffer instanceof NeverBypassBuffer);
    }

    /**
     * @return NeverBypassBufferFactory
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-10-20
     */
    private function getNewFactory()
    {
        return new NeverBypassBufferFactory();
    }
}
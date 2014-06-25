<?php
/**
 * @author stev leibelt <artodeto@bazzline.net>
 * @since 2013-10-20
 */

namespace Test\Net\Bazzline\Component\ProxyLogger\Factory;

use Net\Bazzline\Component\ProxyLogger\BufferManipulator\NeverFlushBufferTrigger;
use Net\Bazzline\Component\ProxyLogger\Factory\NeverFlushBufferTriggerFactory;
use Test\Net\Bazzline\Component\ProxyLogger\TestCase;

/**
 * Class NeverFlushBufferTriggerFactory
 *
 * @package Test\Net\Bazzline\Component\ProxyLogger\Factory
 * @author stev leibelt <artodeto@bazzline.net>
 * @since 2013-10-20
 */
class NeverFlushBufferTriggerFactoryTest extends TestCase
{
    /**
     * @author stev leibelt <artodeto@bazzline.net>
     * @since 2013-10-20
     */
    public function testCreate()
    {
        $factory = $this->getNewFactory();
        $flushBufferTrigger = $factory->create();

        $this->assertTrue($flushBufferTrigger instanceof NeverFlushBufferTrigger);
    }

    /**
     * @return NeverFlushBufferTriggerFactory
     * @author stev leibelt <artodeto@bazzline.net>
     * @since 2013-10-20
     */
    private function getNewFactory()
    {
        return new NeverFlushBufferTriggerFactory();
    }
}
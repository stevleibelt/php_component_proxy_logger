<?php
/**
 * @author stev leibelt <artodeto@bazzline.net>
 * @since 2013-10-20
 */

namespace Test\Net\Bazzline\Component\ProxyLogger\Factory;

use Net\Bazzline\Component\ProxyLogger\BufferManipulator\FlushBufferTrigger;
use Net\Bazzline\Component\ProxyLogger\Factory\FlushBufferTriggerFactory;
use Test\Net\Bazzline\Component\ProxyLogger\TestCase;

/**
 * Class FlushBufferTriggerFactory
 *
 * @package Test\Net\Bazzline\Component\ProxyLogger\Factory
 * @author stev leibelt <artodeto@bazzline.net>
 * @since 2013-10-20
 */
class FlushBufferTriggerFactoryTest extends TestCase
{
    /**
     * @author stev leibelt <artodeto@bazzline.net>
     * @since 2013-10-20
     */
    public function testCreate()
    {
        $factory = $this->getNewFactory();
        $flushBufferTrigger = $factory->create();

        $this->assertTrue($flushBufferTrigger instanceof FlushBufferTrigger);
    }

    /**
     * @return FlushBufferTriggerFactory
     * @author stev leibelt <artodeto@bazzline.net>
     * @since 2013-10-20
     */
    private function getNewFactory()
    {
        return new FlushBufferTriggerFactory();
    }
}
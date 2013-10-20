<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-10-20
 */

namespace Test\Net\Bazzline\Component\ProxyLogger\Factory;

use Net\Bazzline\Component\ProxyLogger\BufferManipulator\UpwardFlushBufferTrigger;
use Net\Bazzline\Component\ProxyLogger\Factory\UpwardFlushBufferTriggerFactory;
use Test\Net\Bazzline\Component\ProxyLogger\TestCase;

/**
 * Class UpwardFlushBufferTriggerFactory
 *
 * @package Test\Net\Bazzline\Component\ProxyLogger\Factory
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-10-20
 */
class UpwardFlushBufferTriggerFactoryTest extends TestCase
{
    /**
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-10-20
     */
    public function testCreate()
    {
        $factory = $this->getNewFactory();
        $flushBufferTrigger = $factory->create();

        $this->assertTrue($flushBufferTrigger instanceof UpwardFlushBufferTrigger);
    }

    /**
     * @return UpwardFlushBufferTriggerFactory
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-10-20
     */
    private function getNewFactory()
    {
        return new UpwardFlushBufferTriggerFactory();
    }
}
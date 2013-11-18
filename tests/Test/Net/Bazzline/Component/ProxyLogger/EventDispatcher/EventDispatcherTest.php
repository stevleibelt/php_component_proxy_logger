<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-11-18 
 */

namespace Test\Net\Bazzline\Component\ProxyLogger\EventDispatcher;

use Net\Bazzline\Component\ProxyLogger\EventDispatcher\EventDispatcher;
use Test\Net\Bazzline\Component\ProxyLogger\TestCase;

/**
 * Class EventDispatcherTest
 * @package Test\Net\Bazzline\Component\ProxyLogger\EventDispatcher
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-11-18
 */
class EventDispatcherTest extends TestCase
{
    /**
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-11-18
     */
    public function testConstructor()
    {
        $dispatcher = new EventDispatcher();

        $this->assertInstanceOf('Net\Bazzline\Component\ProxyLogger\EventDispatcher\EventDispatcherInterface', $dispatcher);
        $this->assertInstanceOf('Net\Bazzline\Component\ProxyLogger\EventDispatcher\EventDispatcher', $dispatcher);
    }
} 
<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-11-18 
 */

namespace Test\Net\Bazzline\Component\ProxyLogger\Event;

use Net\Bazzline\Component\ProxyLogger\Event\Event;
use Test\Net\Bazzline\Component\ProxyLogger\TestCase;

/**
 * Class EventTest
 * @package Test\Net\Bazzline\Component\ProxyLogger\Event
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-11-18
 */
class EventTest extends TestCase
{
    /**
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-11-18
     */
    public function testConstructor()
    {
        $event = new Event;

        $this->assertInstanceOf('Net\Bazzline\Component\ProxyLogger\Event\EventInterface', $event);
    }
} 
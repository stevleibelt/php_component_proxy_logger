<?php
/**
 * @author stev leibelt <artodeto@bazzline.net>
 * @since 2013-08-27
 */

namespace Test\Net\Bazzline\Component\ProxyLogger\Factory;

use Net\Bazzline\Component\ProxyLogger\Factory\LogRequestFactory;
use Psr\Log\LogLevel;
use Test\Net\Bazzline\Component\ProxyLogger\TestCase;

/**
 * Class LogRequestFactoryTest
 *
 * @package Test\Net\Bazzline\Component\ProxyLogger\LogRequest
 * @author stev leibelt <artodeto@bazzline.net>
 * @since 2013-08-27
 */
class LogRequestFactoryTest extends TestCase
{
    /**
     * @author stev leibelt <artodeto@bazzline.net>
     * @since 2013-08-27
     */
    public function testCreate()
    {
        $factory = new LogRequestFactory();
        $level = LogLevel::ALERT;
        $message = 'the message is love';
        $request = $factory->create($level, $message);

        $this->assertInstanceOf('Net\Bazzline\Component\ProxyLogger\LogRequest\LogRequestInterface', $request);
        $this->assertEquals($level, $request->getLevel());
        $this->assertEquals($message, $request->getMessage());
        $this->assertEquals(array(), $request->getContext());
    }
}
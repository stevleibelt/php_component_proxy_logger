<?php
/**
 * @author stev leibelt <artodeto@bazzline.net>
 * @since 2013-08-27
 */

namespace Test\Net\Bazzline\Component\ProxyLogger\Factory;

use Net\Bazzline\Component\ProxyLogger\Factory\DateTimePrefixedMessageLogRequestFactory;
use Psr\Log\LogLevel;
use Test\Net\Bazzline\Component\ProxyLogger\TestCase;

/**
 * Class DateTimePrefixedMessageLogRequestFactoryTest
 *
 * @package Test\Net\Bazzline\Component\ProxyLogger\LogRequest
 * @author stev leibelt <artodeto@bazzline.net>
 * @since 2013-08-27
 */
class DateTimePrefixedMessageLogRequestFactoryTest extends TestCase
{
    /**
     * @author stev leibelt <artodeto@bazzline.net>
     * @since 2013-08-29
     */
    public function testCreate()
    {
        $factory = new DateTimePrefixedMessageLogRequestFactory();
        $level = LogLevel::ALERT;
        $message = 'the message is love';
        $request = $factory->create($level, $message);

        $this->assertInstanceOf('Net\Bazzline\Component\ProxyLogger\LogRequest\LogRequestInterface', $request);
        $this->assertEquals($level, $request->getLevel());
        $this->assertEquals($this->getPrefixedMessage($message), $request->getMessage());
        $this->assertEquals(array(), $request->getContext());
    }

    /**
     * @param $message
     * @return string
     * @author stev leibelt <artodeto@bazzline.net>
     * @since 2013-08-29
     */
    private function getPrefixedMessage($message)
    {
        return date('Y-m-d H:i:s') . '] [' . $message;
    }
}
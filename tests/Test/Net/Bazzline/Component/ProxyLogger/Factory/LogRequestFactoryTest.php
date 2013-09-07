<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
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
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-08-27
 */
class LogRequestFactoryTest extends TestCase
{
    /**
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-27
     */
    public function testCreateWithLogRequest()
    {
        $factory = new LogRequestFactory();
        $level = LogLevel::ALERT;
        $message = 'the message is love';
        $factory->setLogRequestClassName('LogRequest');
        $request = $factory->create($level, $message);

        $this->assertInstanceOf('Net\Bazzline\Component\Logger\LogRequest\LogRequestInterface', $request);
        $this->assertEquals($level, $request->getLevel());
        $this->assertEquals($message, $request->getMessage());
        $this->assertEquals(array(), $request->getContext());
    }

    /**
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-29
     */
    public function testCreateWithDateTimePrefixedMessageLogRequest()
    {
        $factory = new LogRequestFactory();
        $level = LogLevel::ALERT;
        $message = 'the message is love';
        $factory->setLogRequestClassName('DateTimePrefixedMessageLogRequest');
        $request = $factory->create($level, $message);

        $this->assertInstanceOf('Net\Bazzline\Component\Logger\LogRequest\LogRequestInterface', $request);
        $this->assertEquals($level, $request->getLevel());
        $this->assertEquals($this->getPrefixedMessage($message), $request->getMessage());
        $this->assertEquals(array(), $request->getContext());
    }

    /**
     * @param $message
     * @return string
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-29
     */
    private function getPrefixedMessage($message)
    {
        return date('Y-m-d H:i:s') . '] [' . $message;
    }
}
<?php
/**
 * @author stev leibelt <artodeto@bazzline.net>
 * @since 2013-08-27
 */

namespace Test\Net\Bazzline\Component\ProxyLogger\LogRequest;

use Net\Bazzline\Component\ProxyLogger\LogRequest\LogRequest;
use Psr\Log\LogLevel;
use Test\Net\Bazzline\Component\ProxyLogger\TestCase;

/**
 * Class LogRequestTest
 *
 * @package Test\Net\Bazzline\Component\ProxyLogger
 * @author stev leibelt <artodeto@bazzline.net>
 * @since 2013-08-27
 */
class LogRequestTest extends TestCase
{
    /**
     * @author stev leibelt <artodeto@bazzline.net>
     * @since 2013-08-27
     */
    public function testGetLevel()
    {
        $level = LogLevel::ALERT;
        $message = 'test';
        $request = new LogRequest($level, $message);

        $this->assertEquals($level, $request->getLevel());
    }

    /**
     * @author stev leibelt <artodeto@bazzline.net>
     * @since 2013-08-27
     */
    public function testGetMessage()
    {
        $level = LogLevel::ALERT;
        $message = 'test';
        $request = new LogRequest($level, $message);

        $this->assertEquals($message, $request->getMessage());
    }

    /**
     * @author stev leibelt <artodeto@bazzline.net>
     * @since 2013-08-27
     */
    public function testGetContext()
    {
        $level = LogLevel::ALERT;
        $message = 'test';
        $request = new LogRequest($level, $message);

        $this->assertEquals(array(), $request->getContext());
    }
}
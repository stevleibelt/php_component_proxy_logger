<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-08-27 
 */

namespace Test\Net\Bazzline\Component\ProxyLogger\Logger;

use Net\Bazzline\Component\ProxyLogger\Logger\ProxyLogger;
use Psr\Log\LogLevel;
use Test\Net\Bazzline\Component\ProxyLogger\TestCase;

/**
 * Class ProxyLoggerTest
 *
 * @package Test\Net\Bazzline\Component\ProxyLogger
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-08-28
 */
class ProxyLoggerTest extends TestCase
{
    /**
     * @var string
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-28
     */
    private $message;

    /**
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-28
     */
    protected function setUp()
    {
        $this->message = 'the message is love';
    }

    /**
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-28
     */
    public function testAddLogger()
    {
        $logger = $this->getNewLogger();

        $this->assertEquals($logger, $logger->addLogger($this->getNewPsr3LoggerMock()));
    }

    /**
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-10-23
     */
    public function testGetLoggers()
    {
        $proxyLogger = $this->getNewLogger();
        $logger = $this->getNewPsr3LoggerMock();
        $this->assertNull($proxyLogger->getLoggers());

        $proxyLogger->addLogger($logger);
        $this->assertEquals(array($logger), $proxyLogger->getLoggers());
    }

    /**
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-28
     */
    public function testEmergency()
    {
        $logger = $this->getNewLogger();
        $realLogger = $this->getNewPsr3LoggerMock();
        $realLogger->shouldReceive('log')
            ->with(LogLevel::EMERGENCY, $this->message, array())
            ->once();

        $logger->addLogger($realLogger);
        $logger->emergency($this->message);
    }

    /**
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-28
     */
    public function testAlert()
    {
        $logger = $this->getNewLogger();
        $realLogger = $this->getNewPsr3LoggerMock();
        $realLogger->shouldReceive('log')
            ->with(LogLevel::ALERT, $this->message, array())
            ->once();

        $logger->addLogger($realLogger);
        $logger->alert($this->message);
    }

    /**
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-28
     */
    public function testCritical()
    {
        $logger = $this->getNewLogger();
        $realLogger = $this->getNewPsr3LoggerMock();
        $realLogger->shouldReceive('log')
            ->with(LogLevel::CRITICAL, $this->message, array())
            ->once();

        $logger->addLogger($realLogger);
        $logger->critical($this->message);
    }

    /**
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-28
     */
    public function testError()
    {
        $logger = $this->getNewLogger();
        $realLogger = $this->getNewPsr3LoggerMock();
        $realLogger->shouldReceive('log')
            ->with(LogLevel::ERROR, $this->message, array())
            ->once();

        $logger->addLogger($realLogger);
        $logger->error($this->message);
    }

    /**
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-28
     */
    public function testWarning()
    {
        $logger = $this->getNewLogger();
        $realLogger = $this->getNewPsr3LoggerMock();
        $realLogger->shouldReceive('log')
            ->with(LogLevel::WARNING, $this->message, array())
            ->once();

        $logger->addLogger($realLogger);
        $logger->warning($this->message);
    }

    /**
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-28
     */
    public function testNotice()
    {
        $logger = $this->getNewLogger();
        $realLogger = $this->getNewPsr3LoggerMock();
        $realLogger->shouldReceive('log')
            ->with(LogLevel::NOTICE, $this->message, array())
            ->once();

        $logger->addLogger($realLogger);
        $logger->notice($this->message);
    }

    /**
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-28
     */
    public function testInfo()
    {
        $logger = $this->getNewLogger();
        $realLogger = $this->getNewPsr3LoggerMock();
        $realLogger->shouldReceive('log')
            ->with(LogLevel::INFO, $this->message, array())
            ->once();

        $logger->addLogger($realLogger);
        $logger->info($this->message);
    }

    /**
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-28
     */
    public function testDebug()
    {
        $logger = $this->getNewLogger();
        $realLogger = $this->getNewPsr3LoggerMock();
        $realLogger->shouldReceive('log')
            ->with(LogLevel::DEBUG, $this->message, array())
            ->once();

        $logger->addLogger($realLogger);
        $logger->debug($this->message);
    }

    /**
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-28
     */
    public function testLog()
    {
        $logger = $this->getNewLogger();
        $realLogger = $this->getNewPsr3LoggerMock();
        $realLogger->shouldReceive('log')
            ->with(LogLevel::INFO, $this->message, array())
            ->once();

        $logger->addLogger($realLogger);
        $logger->log(LogLevel::INFO, $this->message);
    }

    /**
     * @return ProxyLogger
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-28
     */
    private function getNewLogger()
    {
        return new ProxyLogger();
    }
}
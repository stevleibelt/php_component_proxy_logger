<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-11-18 
 */

namespace Test\Net\Bazzline\Component\ProxyLogger\Logger;

use Psr\Log\LogLevel;
use Test\Net\Bazzline\Component\ProxyLogger\TestCase;

/**
 * Class AbstractLoggerTest
 * @package Test\Net\Bazzline\Component\ProxyLogger\Logger
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-11-18
 */
class AbstractLoggerTest extends TestCase
{
    /**
     * @var string
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-11-14
     */
    private $message;

    /**
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-11-14
     */
    protected function setUp()
    {
        $this->message = 'the message is love';
    }

    /**
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-28
     */
    public function testEmergency()
    {
        $logger = $this->getNewLogger();
        $logger->shouldReceive('log')
            ->with(LogLevel::EMERGENCY, $this->message, array())
            ->once();

        $logger->emergency($this->message);
    }

    /**
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-28
     */
    public function testAlert()
    {
        $logger = $this->getNewLogger();
        $logger->shouldReceive('log')
            ->with(LogLevel::ALERT, $this->message, array())
            ->once();

        $logger->alert($this->message);
    }

    /**
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-28
     */
    public function testCritical()
    {
        $logger = $this->getNewLogger();
        $logger->shouldReceive('log')
            ->with(LogLevel::CRITICAL, $this->message, array())
            ->once();

        $logger->critical($this->message);
    }

    /**
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-28
     */
    public function testError()
    {
        $logger = $this->getNewLogger();
        $logger->shouldReceive('log')
            ->with(LogLevel::ERROR, $this->message, array())
            ->once();

        $logger->error($this->message);
    }

    /**
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-28
     */
    public function testWarning()
    {
        $logger = $this->getNewLogger();
        $logger->shouldReceive('log')
            ->with(LogLevel::WARNING, $this->message, array())
            ->once();

        $logger->warning($this->message);
    }

    /**
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-28
     */
    public function testNotice()
    {
        $logger = $this->getNewLogger();
        $logger->shouldReceive('log')
            ->with(LogLevel::NOTICE, $this->message, array())
            ->once();

        $logger->notice($this->message);
    }

    /**
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-28
     */
    public function testInfo()
    {
        $logger = $this->getNewLogger();
        $logger->shouldReceive('log')
            ->with(LogLevel::INFO, $this->message, array())
            ->once();

        $logger->info($this->message);
    }

    /**
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-28
     */
    public function testDebug()
    {
        $logger = $this->getNewLogger();
        $logger->shouldReceive('log')
            ->with(LogLevel::DEBUG, $this->message, array())
            ->once();

        $logger->debug($this->message);
    }

    /**
     * @return \Mockery\MockInterface|\Net\Bazzline\Component\ProxyLogger\Logger\AbstractLogger
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-11-18
     */
    protected function getNewLogger()
    {
        return $this->getNewAbstractLogger();
    }
} 
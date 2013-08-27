<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-08-28 
 */

namespace Test\Net\Bazzline\Component\Logger;

use Net\Bazzline\Component\Logger\TriggeredBufferLogger;
use Psr\Log\LogLevel;

/**
 * Class TriggeredBufferLoggerTest
 *
 * @package Test\Net\Bazzline\Component\Logger
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-08-28
 */
class TriggeredBufferLoggerTest extends TestCase
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
    public function testSetTriggerToLogLevelEmergency()
    {
        $logger = $this->getNewLogger();
        $logger->setTriggerToLogLevelEmergency();

        $this->assertEquals(LogLevel::EMERGENCY, $logger->getTriggerToLovLevel());
    }

    /**
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-28
     */
    public function testSetTriggerToLogLevelAlert()
    {
        $logger = $this->getNewLogger();
        $logger->setTriggerToLogLevelAlert();

        $this->assertEquals(LogLevel::ALERT, $logger->getTriggerToLovLevel());
    }

    /**
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-28
     */
    public function testSetTriggerToLogLevelCritical()
    {
        $logger = $this->getNewLogger();
        $logger->setTriggerToLogLevelCritical();

        $this->assertEquals(LogLevel::CRITICAL, $logger->getTriggerToLovLevel());
    }

    /**
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-28
     */
    public function testSetTriggerToLogLevelError()
    {
        $logger = $this->getNewLogger();
        $logger->setTriggerToLogLevelError();

        $this->assertEquals(LogLevel::ERROR, $logger->getTriggerToLovLevel());
    }

    /**
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-28
     */
    public function testSetTriggerToLogLevelWarning()
    {
        $logger = $this->getNewLogger();
        $logger->setTriggerToLogLevelWarning();

        $this->assertEquals(LogLevel::WARNING, $logger->getTriggerToLovLevel());
    }

    /**
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-28
     */
    public function testSetTriggerToLogLevelNotice()
    {
        $logger = $this->getNewLogger();
        $logger->setTriggerToLogLevelNotice();

        $this->assertEquals(LogLevel::NOTICE, $logger->getTriggerToLovLevel());
    }

    /**
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-28
     */
    public function testSetTriggerToLogLevelInfo()
    {
        $logger = $this->getNewLogger();
        $logger->setTriggerToLogLevelInfo();

        $this->assertEquals(LogLevel::INFO, $logger->getTriggerToLovLevel());
    }

    /**
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-28
     */
    public function testSetTriggerToLogLevelDebug()
    {
        $logger = $this->getNewLogger();
        $logger->setTriggerToLogLevelDebug();

        $this->assertEquals(LogLevel::DEBUG, $logger->getTriggerToLovLevel());
    }

    /**
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-28
     */
    public function testInjectLogEntryFactory()
    {
        $factory = $this->getLogEntryFactory($this->getLogEntry());
        $factory->shouldReceive('create')
            ->never();
        $logger = $this->getNewLogger();

        $this->assertEquals($logger, $logger->injectLogEntryFactory($factory));
    }

    /**
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-28
     */
    public function testSetTriggerToLogLevel()
    {
        $logger = $this->getNewLogger();
        $logger->setTriggerToLogLevel(LogLevel::CRITICAL);

        $this->assertEquals(LogLevel::CRITICAL, $logger->getTriggerToLovLevel());
    }

    /**
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-28
     */
    public function testSetTriggeredLogLevelInheritanceMap()
    {
        $logger = $this->getNewLogger();
        $map = array(
            LogLevel::CRITICAL => array(
                LogLevel::EMERGENCY
            )
        );

        $this->assertEquals($logger, $logger->setTriggeredLogLevelInheritanceMap($map));
    }

    /**
     * @return TriggeredBufferLogger
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-28
     */
    private function getNewLogger()
    {
        return new TriggeredBufferLogger();
    }
}
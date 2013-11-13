<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-08-27 
 */

namespace Test\Net\Bazzline\Component\ProxyLogger\Logger;

use Net\Bazzline\Component\ProxyLogger\Event\ProxyEvent;
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
    public function testLog()
    {
        $logger = $this->getNewLogger();
        $request = $this->getNewLogRequestMock();
        $realLogger = $this->getNewPsr3LoggerMock();
        $factory = $this->getNewLogRequestFactoryMock($request);
        $event = $this->getNewEventMock();
        $event->shouldReceive('setLogRequest')
            ->once();
        $event->shouldReceive('setLoggerCollection')
            ->once();
        $dispatcher = $this->getNewEventDispatcherMock();
        $dispatcher->shouldReceive('dispatch')
            ->with(ProxyEvent::LOG_LOG_REQUEST, $event)
            ->once();

        $logger->addLogger($realLogger);
        $logger->setEvent($event);
        $logger->setEventDispatcher($dispatcher);
        $logger->setLogRequestFactory($factory);
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
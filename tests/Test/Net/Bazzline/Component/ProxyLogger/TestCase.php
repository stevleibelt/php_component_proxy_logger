<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-08-26
 */

namespace Test\Net\Bazzline\Component\ProxyLogger;

use Net\Bazzline\Component\ProxyLogger\BufferManipulator\BypassBuffer;
use Net\Bazzline\Component\ProxyLogger\Factory\FlushBufferTriggerFactory;
use Net\Bazzline\Component\ProxyLogger\LogRequest\LogRequestBufferInterface;
use Net\Bazzline\Component\ProxyLogger\LogRequest\LogRequestInterface;
use Net\Bazzline\Component\ProxyLogger\LogRequest\LogRequestRuntimeBuffer;
use Mockery;
use Net\Bazzline\Component\ProxyLogger\Validator\IsValidLogLevel;
use PHPUnit_Framework_TestCase;

/**
 * Class TestCase
 *
 * @package Test\Net\Bazzline\Component\ProxyLogger
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-08-26
 */
class TestCase extends PHPUnit_Framework_TestCase
{
    /**
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-26
     */
    protected function tearDown()
    {
        Mockery::close();
    }

    /**
     * @return Mockery\MockInterface|\Psr\Log\NullLogger
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-27
     */
    protected function getNewPsr3LoggerMock()
    {
        return Mockery::mock('Psr\Log\NullLogger');
    }

    /**
     * @return Mockery\MockInterface|\Net\Bazzline\Component\ProxyLogger\LogRequest\LogRequest
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-27
     */
    protected function getNewLogRequestMock()
    {
        return Mockery::mock('Net\Bazzline\Component\ProxyLogger\LogRequest\LogRequest');
    }

    /**
     * @param LogRequestInterface $logRequest
     * @return Mockery\MockInterface|\Net\Bazzline\Component\ProxyLogger\LogRequest\LogRequestRuntimeBuffer
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-27
     */
    protected function getNewLogRequestRuntimeBufferMock(LogRequestInterface $logRequest)
    {
        $mock = Mockery::mock('Net\Bazzline\Component\ProxyLogger\LogRequest\LogRequestRuntimeBuffer');

        return $mock;
    }

    /**
     * @return Mockery\MockInterface|\Net\Bazzline\Component\ProxyLogger\Factory\LogRequestFactory
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-28
     */
    protected function getNewPlainLogRequestFactoryMock()
    {
        return Mockery::mock('Net\Bazzline\Component\ProxyLogger\Factory\LogRequestFactory');
    }

    /**
     * @param LogRequestInterface $logRequest
     * @return Mockery\MockInterface|\Net\Bazzline\Component\ProxyLogger\Factory\LogRequestFactory
     * @author stev leibelt <artodeto@arcor.de>
     * @since
     */
    protected function getNewLogRequestFactoryMock(LogRequestInterface $logRequest)
    {
        $mock = $this->getNewPlainLogRequestFactoryMock();
        $mock->shouldReceive('create')
            ->andReturn($logRequest)
            ->once()
            ->byDefault();

        return $mock;
    }

    /**
     * @return Mockery\MockInterface|\Net\Bazzline\Component\ProxyLogger\Factory\LogRequestRuntimeBufferFactory
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-27
     */
    protected function getNewPlainLogRequestBufferFactoryMock()
    {
        return Mockery::mock('Net\Bazzline\Component\ProxyLogger\Factory\LogRequestRuntimeBufferFactory');
    }

    /**
     * @param LogRequestBufferInterface $buffer
     * @return Mockery\MockInterface|\Net\Bazzline\Component\ProxyLogger\Factory\LogRequestRuntimeBufferFactory
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-27
     */
    protected function getNewLogRequestBufferFactoryMock(LogRequestBufferInterface $buffer)
    {
        $mock = $this->getNewPlainLogRequestBufferFactoryMock();
        $mock->shouldReceive('create')
            ->andReturn($buffer)
            ->once()
            ->byDefault();

        return $mock;
    }

    /**
     * @return Mockery\MockInterface|\Net\Bazzline\Component\ProxyLogger\BufferManipulator\FlushBufferTriggerInterface
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-09-06
     */
    protected function getNewAbstractFlushBufferTriggerMock()
    {
        return Mockery::mock('Net\Bazzline\Component\ProxyLogger\BufferManipulator\AbstractFlushBufferTrigger[triggerBufferFlush]');
    }

    /**
     * @return Mockery\MockInterface|\Net\Bazzline\Component\ProxyLogger\Validator\IsValidLogLevel
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-09-06
     */
    protected function getNewIsValidLogLevelMock()
    {
        return Mockery::mock('Net\Bazzline\Component\ProxyLogger\Validator\IsValidLogLevel');
    }

    /**
     * @return IsValidLogLevel
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-10-20
     */
    protected function getNewIsValidLogLevel()
    {
        return new IsValidLogLevel();
    }

    /**
     * @return Mockery\MockInterface|\Net\Bazzline\Component\ProxyLogger\BufferManipulator\BypassBuffer
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-09-06
     */
    protected function getNewBypassBufferMock()
    {
        return Mockery::mock('Net\Bazzline\Component\ProxyLogger\BufferManipulator\BypassBuffer');
    }

    /**
     * @return Mockery\MockInterface|\Net\Bazzline\Component\ProxyLogger\Factory\BypassBufferFactoryInterface
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-10-20
     */
    protected function getNewAbstractBypassBufferFactoryMock()
    {
        return Mockery::mock('Net\Bazzline\Component\ProxyLogger\Factory\AbstractBypassBufferFactory[createNewBypassBufferInstance]');
    }

    /**
     * @return Mockery\MockInterface|\Net\Bazzline\Component\ProxyLogger\Factory\BypassBufferFactoryInterface
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-10-20
     */
    protected function getNewBypassBufferFactoryMock()
    {
        return Mockery::mock('Net\Bazzline\Component\ProxyLogger\Factory\BypassBufferFactory');
    }

    /**
     * @return Mockery\MockInterface|\Net\Bazzline\Component\ProxyLogger\Factory\FlushBufferTriggerFactoryInterface
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-10-20
     */
    protected function getNewAbstractFlushBufferTriggerFactoryMock()
    {
        return Mockery::mock('Net\Bazzline\Component\ProxyLogger\Factory\AbstractFlushBufferTriggerFactory[createNewFlushBufferTriggerInstance]');
    }

    /**
     * @return Mockery\MockInterface|\Net\Bazzline\Component\ProxyLogger\Factory\FlushBufferTriggerFactoryInterface
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-10-20
     */
    protected function getNewFlushBufferTriggerFactoryMock()
    {
        return Mockery::mock('Net\Bazzline\Component\ProxyLogger\Factory\FlushBufferTriggerFactory');
    }

    /**
     * @return Mockery\MockInterface|\Net\Bazzline\Component\ProxyLogger\Event\Event'
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-11-13
     */
    protected function getNewEventMock()
    {
        return Mockery::mock('Net\Bazzline\Component\ProxyLogger\Event\Event');
    }

    /**
     * @return Mockery\MockInterface|\Net\Bazzline\Component\ProxyLogger\EventDispatcher\EventDispatcher
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-11-13
     */
    protected function getNewEventDispatcherMock()
    {
        return Mockery::mock('Net\Bazzline\Component\ProxyLogger\EventDispatcher\EventDispatcher');
    }
}
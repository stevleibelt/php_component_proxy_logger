<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-08-26
 */

namespace Test\Net\Bazzline\Component\Logger;

use Net\Bazzline\Component\Logger\LogRequest\LogRequestBufferInterface;
use Net\Bazzline\Component\Logger\LogRequest\LogRequestInterface;
use Net\Bazzline\Component\Logger\LogRequest\LogRequestRuntimeBuffer;
use Mockery;
use PHPUnit_Framework_TestCase;

/**
 * Class TestCase
 *
 * @package Test\Net\Bazzline\Component\Logger
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
    protected function getPsr3Logger()
    {
        $mock = Mockery::mock('Psr\Log\NullLogger');

        return $mock;
    }

    /**
     * @return Mockery\MockInterface|\Net\Bazzline\Component\Logger\LogRequest\LogRequest
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-27
     */
    protected function getLogRequest()
    {
        $mock = Mockery::mock('Net\Bazzline\Component\Logger\LogRequest\LogRequest');

        return $mock;
    }

    /**
     * @param LogRequestInterface $logRequest
     * @return Mockery\MockInterface|\Net\Bazzline\Component\Logger\LogRequest\LogRequestRuntimeBuffer
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-27
     */
    protected function getLogRequestRuntimeBuffer(LogRequestInterface $logRequest)
    {
        $mock = Mockery::mock('Net\Bazzline\Component\Logger\LogRequest\LogRequestRuntimeBuffer');

        $mock->shouldReceive('attach')
            ->with($logRequest)
            ->once()
            ->byDefault();

        return $mock;
    }

    /**
     * @return Mockery\MockInterface|\Net\Bazzline\Component\Logger\Factory\LogRequestFactory
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-28
     */
    protected function getPlainLogRequestFactory()
    {
        $mock = Mockery::mock('Net\Bazzline\Component\Logger\Factory\LogRequestFactory');

        return $mock;
    }

    /**
     * @param LogRequestInterface $logRequest
     * @return Mockery\MockInterface|\Net\Bazzline\Component\Logger\Factory\LogRequestFactory
     * @author stev leibelt <artodeto@arcor.de>
     * @since
     */
    protected function getLogRequestFactory(LogRequestInterface $logRequest)
    {
        $mock = $this->getPlainLogRequestFactory();
        $mock->shouldReceive('create')
            ->andReturn($logRequest)
            ->once()
            ->byDefault();

        return $mock;
    }

    /**
     * @return Mockery\MockInterface|\Net\Bazzline\Component\Logger\Factory\LogRequestRuntimeBufferFactory
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-27
     */
    protected function getPlainLogRequestBufferFactory()
    {
        $mock = Mockery::mock('Net\Bazzline\Component\Logger\Factory\LogRequestRuntimeBufferFactory');

        return $mock;
    }

    /**
     * @param LogRequestBufferInterface $buffer
     * @return Mockery\MockInterface|\Net\Bazzline\Component\Logger\Factory\LogRequestRuntimeBufferFactory
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-27
     */
    protected function getLogRequestBufferFactory(LogRequestBufferInterface $buffer)
    {
        $mock = $this->getPlainLogRequestBufferFactory();
        $mock->shouldReceive('create')
            ->andReturn($buffer)
            ->twice()
            ->byDefault();

        return $mock;
    }

    /**
     * @return Mockery\MockInterface|\Net\Bazzline\Component\Logger\BufferManipulation\AlwaysFlushBufferTrigger
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-09-06
     */
    protected function getNewAbstractFlushBufferTrigger()
    {
        return Mockery::mock('Net\Bazzline\Component\Logger\BufferManipulation\AlwaysFlushBufferTrigger[triggerBufferFlush]');
    }

    /**
     * @return Mockery\MockInterface|\Net\Bazzline\Component\Logger\Validator\IsValidLogLevel
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-09-06
     */
    protected function getIsValidLogLevel()
    {
        return Mockery::mock('Net\Bazzline\Component\Logger\Validator\IsValidLogLevel');
    }

    /**
     * @return Mockery\MockInterface|\Net\Bazzline\Component\Logger\BufferManipulation\BypassBuffer
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-09-06
     */
    protected function getBypassBuffer()
    {
        return Mockery::mock('Net\Bazzline\Component\Logger\BufferManipulation\BypassBuffer');
    }
}
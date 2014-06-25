<?php
/**
 * @author stev leibelt <artodeto@bazzline.net>
 * @since 2013-08-26
 */

namespace Test\Net\Bazzline\Component\ProxyLogger;

use Net\Bazzline\Component\ProxyLogger\EventDispatcher\EventDispatcher;
use Net\Bazzline\Component\ProxyLogger\LogRequest\LogRequestBufferInterface;
use Net\Bazzline\Component\ProxyLogger\LogRequest\LogRequestInterface;
use Mockery;
use Net\Bazzline\Component\ProxyLogger\Validator\IsValidLogLevel;
use PHPUnit_Framework_TestCase;

/**
 * Class TestCase
 *
 * @package Test\Net\Bazzline\Component\ProxyLogger
 * @author stev leibelt <artodeto@bazzline.net>
 * @since 2013-08-26
 * @todo remove unused get methods
 */
class TestCase extends PHPUnit_Framework_TestCase
{
    /**
    * Merge data with default preconditions and expectations
    *
    * @param array $testCases
    * @param array $preconditions
    * @param array $expectations
    * @return array
    * @author stev leibelt <artodeto@bazzline.net>
    * @since 2013-11-22
    */
    protected static function mergeTestCasesWithDefaults(array $testCases, array $preconditions, array $expectations)
    {
        foreach ($testCases as &$testCase) {
            if (isset($testCase['preconditions'])) {
                $testCase['preconditions'] = array_merge($preconditions, $testCase['preconditions']);
            } else {
                $testCase['preconditions'] = $preconditions;
            }
            if (isset($testCase['expectations'])) {
                $testCase['expectations'] = array_merge($expectations, $testCase['expectations']);
            } else {
                $testCase['expectations'] = $expectations;
            }
        }

        return $testCases;
    }

    /**
     * @author stev leibelt <artodeto@bazzline.net>
     * @since 2013-08-26
     */
    protected function tearDown()
    {
        Mockery::close();
    }

    /**
     * @return Mockery\MockInterface|\Psr\Log\NullLogger
     * @author stev leibelt <artodeto@bazzline.net>
     * @since 2013-08-27
     */
    protected function getNewPsr3LoggerMock()
    {
        return Mockery::mock('Psr\Log\NullLogger');
    }

    /**
     * @return Mockery\MockInterface|\Net\Bazzline\Component\ProxyLogger\LogRequest\LogRequest
     * @author stev leibelt <artodeto@bazzline.net>
     * @since 2013-08-27
     */
    protected function getNewLogRequestMock()
    {
        return Mockery::mock('Net\Bazzline\Component\ProxyLogger\LogRequest\LogRequest');
    }

    /**
     * @return Mockery\MockInterface|\Net\Bazzline\Component\ProxyLogger\LogRequest\LogRequestRuntimeBuffer
     * @author stev leibelt <artodeto@bazzline.net>
     * @since 2013-08-27
     */
    protected function getNewLogRequestRuntimeBufferMock()
    {
        $mock = Mockery::mock('Net\Bazzline\Component\ProxyLogger\LogRequest\LogRequestRuntimeBuffer');

        return $mock;
    }

    /**
     * @return Mockery\MockInterface|\Net\Bazzline\Component\ProxyLogger\Factory\LogRequestFactory
     * @author stev leibelt <artodeto@bazzline.net>
     * @since 2013-08-28
     */
    protected function getNewPlainLogRequestFactoryMock()
    {
        return Mockery::mock('Net\Bazzline\Component\ProxyLogger\Factory\LogRequestFactory');
    }

    /**
     * @param LogRequestInterface $logRequest
     * @return Mockery\MockInterface|\Net\Bazzline\Component\ProxyLogger\Factory\LogRequestFactory
     * @author stev leibelt <artodeto@bazzline.net>
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
     * @author stev leibelt <artodeto@bazzline.net>
     * @since 2013-08-27
     */
    protected function getNewPlainLogRequestBufferFactoryMock()
    {
        return Mockery::mock('Net\Bazzline\Component\ProxyLogger\Factory\LogRequestRuntimeBufferFactory');
    }

    /**
     * @param LogRequestBufferInterface $buffer
     * @return Mockery\MockInterface|\Net\Bazzline\Component\ProxyLogger\Factory\LogRequestRuntimeBufferFactory
     * @author stev leibelt <artodeto@bazzline.net>
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
     * @author stev leibelt <artodeto@bazzline.net>
     * @since 2013-09-06
     */
    protected function getNewAbstractFlushBufferTriggerMock()
    {
        return Mockery::mock('Net\Bazzline\Component\ProxyLogger\BufferManipulator\AbstractFlushBufferTrigger[triggerBufferFlush]');
    }

    /**
     * @return Mockery\MockInterface|\Net\Bazzline\Component\ProxyLogger\Validator\IsValidLogLevel
     * @author stev leibelt <artodeto@bazzline.net>
     * @since 2013-09-06
     */
    protected function getNewIsValidLogLevelMock()
    {
        return Mockery::mock('Net\Bazzline\Component\ProxyLogger\Validator\IsValidLogLevel');
    }

    /**
     * @return IsValidLogLevel
     * @author stev leibelt <artodeto@bazzline.net>
     * @since 2013-10-20
     */
    protected function getNewIsValidLogLevel()
    {
        return new IsValidLogLevel();
    }

    /**
     * @return Mockery\MockInterface|\Net\Bazzline\Component\ProxyLogger\BufferManipulator\BypassBuffer
     * @author stev leibelt <artodeto@bazzline.net>
     * @since 2013-09-06
     */
    protected function getNewBypassBufferMock()
    {
        return Mockery::mock('Net\Bazzline\Component\ProxyLogger\BufferManipulator\BypassBuffer');
    }

    /**
     * @return Mockery\MockInterface|\Net\Bazzline\Component\ProxyLogger\BufferManipulator\FlushBufferTrigger
     * @author stev leibelt <artodeto@bazzline.net>
     * @since 2013-09-06
     */
    protected function getNewFlushBufferTriggerMock()
    {
        return Mockery::mock('Net\Bazzline\Component\ProxyLogger\BufferManipulator\FlushBufferTrigger');
    }

    /**
     * @return Mockery\MockInterface|\Net\Bazzline\Component\ProxyLogger\Factory\BypassBufferFactoryInterface
     * @author stev leibelt <artodeto@bazzline.net>
     * @since 2013-10-20
     */
    protected function getNewAbstractBypassBufferFactoryMock()
    {
        return Mockery::mock('Net\Bazzline\Component\ProxyLogger\Factory\AbstractBypassBufferFactory[createNewBypassBufferInstance]');
    }

    /**
     * @return Mockery\MockInterface|\Net\Bazzline\Component\ProxyLogger\Factory\BypassBufferFactoryInterface
     * @author stev leibelt <artodeto@bazzline.net>
     * @since 2013-10-20
     */
    protected function getNewBypassBufferFactoryMock()
    {
        return Mockery::mock('Net\Bazzline\Component\ProxyLogger\Factory\BypassBufferFactory');
    }

    /**
     * @return Mockery\MockInterface|\Net\Bazzline\Component\ProxyLogger\Factory\FlushBufferTriggerFactoryInterface
     * @author stev leibelt <artodeto@bazzline.net>
     * @since 2013-10-20
     */
    protected function getNewAbstractFlushBufferTriggerFactoryMock()
    {
        return Mockery::mock('Net\Bazzline\Component\ProxyLogger\Factory\AbstractFlushBufferTriggerFactory[createNewFlushBufferTriggerInstance]');
    }

    /**
     * @return Mockery\MockInterface|\Net\Bazzline\Component\ProxyLogger\Factory\FlushBufferTriggerFactoryInterface
     * @author stev leibelt <artodeto@bazzline.net>
     * @since 2013-10-20
     */
    protected function getNewFlushBufferTriggerFactoryMock()
    {
        return Mockery::mock('Net\Bazzline\Component\ProxyLogger\Factory\FlushBufferTriggerFactory');
    }

    /**
     * @return Mockery\MockInterface|\Net\Bazzline\Component\ProxyLogger\Event\Event'
     * @author stev leibelt <artodeto@bazzline.net>
     * @since 2013-11-13
     */
    protected function getNewEventMock()
    {
        return Mockery::mock('Net\Bazzline\Component\ProxyLogger\Event\Event');
    }

    /**
     * @return Mockery\MockInterface|\Net\Bazzline\Component\ProxyLogger\Event\BufferEvent'
     * @author stev leibelt <artodeto@bazzline.net>
     * @since 2013-11-13
     */
    protected function getNewBufferEventMock()
    {
        return Mockery::mock('Net\Bazzline\Component\ProxyLogger\Event\BufferEvent');
    }

    /**
     * @return Mockery\MockInterface|\Net\Bazzline\Component\ProxyLogger\Event\ManipulateBufferEvent'
     * @author stev leibelt <artodeto@bazzline.net>
     * @since 2013-11-13
     */
    protected function getNewManipulateBufferEventMock()
    {
        return Mockery::mock('Net\Bazzline\Component\ProxyLogger\Event\ManipulateBufferEvent');
    }

    /**
     * @return Mockery\MockInterface|\Net\Bazzline\Component\ProxyLogger\EventDispatcher\EventDispatcher
     * @author stev leibelt <artodeto@bazzline.net>
     * @since 2013-11-13
     */
    protected function getNewEventDispatcherMock()
    {
        return Mockery::mock('Net\Bazzline\Component\ProxyLogger\EventDispatcher\EventDispatcher');
    }

    /**
     * @return EventDispatcher
     * @author stev leibelt <artodeto@bazzline.net>
     * @since 2013-11-21
     */
    protected function getNewEventDispatcher()
    {
        return new EventDispatcher();
    }

    /**
     * @return Mockery\MockInterface|\Net\Bazzline\Component\ProxyLogger\Logger\AbstractLogger
     * @author stev leibelt <artodeto@bazzline.net>
     * @since 2013-11-13
     */
    protected function getNewAbstractLogger()
    {
        return Mockery::mock('Net\Bazzline\Component\ProxyLogger\Logger\AbstractLogger[log]');
    }

    /**
     * @return Mockery\MockInterface|\Net\Bazzline\Component\ProxyLogger\Logger\AbstractProxyLogger
     * @author stev leibelt <artodeto@bazzline.net>
     * @since 2013-11-13
     */
    protected function getNewAbstractProxyLogger()
    {
        return Mockery::mock('Net\Bazzline\Component\ProxyLogger\Logger\AbstractProxyLogger[log]');
    }

    /**
     * @return Mockery\MockInterface|\Net\Bazzline\Component\ProxyLogger\Factory\AbstractLogRequestFactory
     * @author stev leibelt <artodeto@bazzline.net>
     * @since 2013-11-21
     */
    protected function getNewAbstractLogRequestFactory()
    {
        return Mockery::mock('Net\Bazzline\Component\ProxyLogger\Factory\AbstractLogRequestFactory[createNewLogRequestInstance]');
    }
}

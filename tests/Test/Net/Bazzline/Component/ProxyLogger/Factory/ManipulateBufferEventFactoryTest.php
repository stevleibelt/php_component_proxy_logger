<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-11-18 
 */

namespace Test\Net\Bazzline\Component\ProxyLogger\Factory;

use Net\Bazzline\Component\ProxyLogger\Factory\ManipulateBufferEventFactory;
use Test\Net\Bazzline\Component\ProxyLogger\TestCase;

/**
 * Class ManipulateBufferEventFactoryTest
 * @package Test\Net\Bazzline\Component\ProxyLogger\Factory
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-11-18
 */
class ManipulateBufferEventFactoryTest extends TestCase
{
    /**
     * @return array
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-11-24
     */
    public static function createTestCaseProvider()
    {
        $preconditions = array(
            'setBypassBuffer' => true,
            'setFlushBufferTrigger' => true,
            'setLoggerCollection' => true,
            'setLogRequestBuffer' => true,
            'setLogRequest' => true
        );
        $expectations = array(
            'hasBypassBuffer' => true,
            'hasFlushBufferTrigger' => true,
            'hasLoggerCollection' => true,
            'hasLogRequestBuffer' => true
        );

        $testCases = array(
            'has all' => array(
                'preconditions' => array(),
                'expectations' => array()
            ),
            'has none' => array(
                'preconditions' => array(
                    'setBypassBuffer' => false,
                    'setFlushBufferTrigger' => false,
                    'setLoggerCollection' => false,
                    'setLogRequestBuffer' => false,
                    'setLogRequest' => false
                ),
                'expectations' => array(
                    'hasBypassBuffer' => false,
                    'hasFlushBufferTrigger' => false,
                    'hasLoggerCollection' => false,
                    'hasLogRequestBuffer' => false
                )
            )
        );

        return self::mergeTestCasesWithDefaults($testCases, $preconditions, $expectations);
    }

    /**
     * @dataProvider createTestCaseProvider
     * @param array $preconditions
     * @param array $expectations
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-11-19
     * @todo implement test cases
     *  - (hasBypassBuffer^!hasFlushBufferTrigger^!hasLoggerCollection^!hasLogRequestBuffer^!hasLogRequest)
     *  - (!hasBypassBuffer^hasFlushBufferTrigger^!hasLoggerCollection^!hasLogRequestBuffer^!hasLogRequest)
     *  - ...
     *  - (hasBypassBuffer^hasFlushBufferTrigger^hasLoggerCollection^hasLogRequestBuffer^hasLogRequest)
     */
    public function testCreate(array $preconditions, array $expectations)
    {
        $factory = new ManipulateBufferEventFactory();

        $bypassBuffer =  ($preconditions['setBypassBuffer'])
            ? $bypassBuffer = $this->getNewBypassBufferMock()
            : null;
        $flushBufferTrigger =  ($preconditions['setFlushBufferTrigger'])
            ? $flushBufferTrigger = $this->getNewFlushBufferTriggerMock()
            : null;
        $loggerCollection =  ($preconditions['setLoggerCollection'])
            ? $loggerCollection = array($this->getNewPsr3LoggerMock())
            : array();
        $logRequestBuffer =  ($preconditions['setLogRequestBuffer'])
            ? $logRequestBuffer = $this->getNewLogRequestRuntimeBufferMock()
            : null;
        $logRequest =  ($preconditions['setLogRequest'])
            ? $logRequest = $this->getNewLogRequestMock()
            : null;

        $event = $factory->create(
            $loggerCollection,
            $logRequestBuffer,
            $logRequest,
            $flushBufferTrigger,
            $bypassBuffer
        );

        $this->assertEquals($expectations['hasBypassBuffer'], $event->hasBypassBuffer());
        $this->assertSame($bypassBuffer, $event->getBypassBuffer());
        $this->assertEquals($expectations['hasFlushBufferTrigger'], $event->hasFlushBufferTrigger());
        $this->assertSame($flushBufferTrigger, $event->getFlushBufferTrigger());
        $this->assertEquals($expectations['hasLoggerCollection'], (count($event->getLoggerCollection()) > 0));
        $this->assertSame($loggerCollection, $event->getLoggerCollection());
        $this->assertEquals($expectations['hasLogRequestBuffer'], $event->hasLogRequestBuffer());
        $this->assertSame($logRequestBuffer, $event->getLogRequestBuffer());
        $this->assertSame($logRequest, $event->getLogRequest());
    }
}
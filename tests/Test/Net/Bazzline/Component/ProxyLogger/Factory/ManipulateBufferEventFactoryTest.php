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
            'hasBypassBuffer' => true,
            'hasFlushBufferTrigger' => true,
            'hasLoggerCollection' => true,
            'hasLogRequestBuffer' => true,
            'hasLogRequest' => true
        );
        $expectations = array();

        $testCases = array(
            'has all' => array(
                'preconditions' => array(),
                'expectations' => array()
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
        $event = $factory->create();

        $this->assertFalse($event->hasBypassBuffer());
        $this->assertFalse($event->hasFlushBufferTrigger());
        $this->assertSame(array(), $event->getLoggerCollection());
        $this->assertNull($event->getBypassBuffer());
        $this->assertNull($event->getFlushBufferTrigger());
        $this->assertNull($event->getLogRequestBuffer());
        $this->assertNull($event->getLogRequest());
    }
}
<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-11-18 
 */

namespace Test\Net\Bazzline\Component\ProxyLogger\Factory;

use Net\Bazzline\Component\ProxyLogger\Factory\ProxyEventFactory;
use Test\Net\Bazzline\Component\ProxyLogger\TestCase;

/**
 * Class ProxyEventFactoryTest
 * @package Test\Net\Bazzline\Component\ProxyLogger\Factory
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-11-18
 */
class ProxyEventFactoryTest extends TestCase
{
    /**
     * @return array
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-11-22
     */
    public static function createTestCaseDataProvider()
    {
        $preconditions = array(
            'setLoggerCollection' => true,
            'setLogRequest' => true
        );
        $expectations = array(
            'hasLoggerCollection' => true,
            'hasLogRequest' => true
        );
        $testCases = array(
            'has logger and request' => array(
                'preconditions' => array(),
                'expectations' => array()
            ),
            'has logger and no request' => array(
                'preconditions' => array(
                    'setLogRequest' => false
                ),
                'expectations' => array(
                    'hasLogRequest' => false
                )
            ),
            'has no logger and request' => array(
                'preconditions' => array(
                    'setLoggerCollection' => false
                ),
                'expectations' => array(
                    'hasLoggerCollection' => false
                )
            ),
            'has no logger and no request' => array(
                'preconditions' => array(
                    'setLoggerCollection' => false,
                    'setLogRequest' => false
                ),
                'expectations' => array(
                    'hasLoggerCollection' => false,
                    'hasLogRequest' => false
                )
            )
        );

        return self::mergeTestCasesWithDefaults($testCases, $preconditions, $expectations);
    }

    /**
     * @dataProvider createTestCaseDataProvider
     *
     * @param array $preconditions
     * @param array $expectations
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-11-18
     */
    public function testCreate(array $preconditions, array $expectations)
    {
        $factory = new ProxyEventFactory();

        $loggerCollection = ($preconditions['setLoggerCollection'])
            ? array(
                $this->getNewPsr3LoggerMock(),
                $this->getNewPsr3LoggerMock()
            )
            : array();
        $logRequest = ($preconditions['setLogRequest'])
            ? $this->getNewLogRequestMock()
            : null;
        $event = $factory->create($loggerCollection, $logRequest);

        $this->assertEquals($loggerCollection, $event->getLoggerCollection());
        $this->assertEquals($logRequest, $event->getLogRequest());
    }
} 

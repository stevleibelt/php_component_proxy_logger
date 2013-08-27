<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-08-28 
 */

namespace Test\Net\Bazzline\Component\Logger;

use Net\Bazzline\Component\Logger\TriggeredBufferLoggerFactory;
use Psr\Log\LogLevel;

/**
 * Class TriggeredBufferLoggerFactoryTest
 *
 * @package Test\Net\Bazzline\Component\Logger
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-08-28
 */
class TriggeredBufferLoggerFactoryTest extends TestCase
{
    /**
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-28
     */
    public function testCreate()
    {
        $factory = new TriggeredBufferLoggerFactory();
        $logger = $this->getPsr3Logger();
        $buffer = $factory->create($logger, LogLevel::ERROR);

        $this->assertInstanceOf('Net\Bazzline\Component\Logger\TriggeredBufferLoggerInterface', $buffer);
        $this->assertInstanceOf('Net\Bazzline\Component\Logger\TriggeredBufferLogger', $buffer);
        $this->assertEquals(LogLevel::ERROR, $buffer->getTriggerToLogLevel());
    }
}
<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-08-28 
 */

namespace Test\Net\Bazzline\Component\Logger;

use Net\Bazzline\Component\Logger\TriggerBufferLoggerFactory;
use Psr\Log\LogLevel;

/**
 * Class TriggerBufferLoggerFactoryTest
 *
 * @package Test\Net\Bazzline\Component\Logger
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-08-28
 */
class TriggerBufferLoggerFactoryTest extends TestCase
{
    /**
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-28
     */
    public function testCreate()
    {
        $factory = new TriggerBufferLoggerFactory();
        $logger = $this->getPsr3Logger();
        $buffer = $factory->create($logger, LogLevel::ERROR);

        $this->assertInstanceOf('Net\Bazzline\Component\Logger\TriggerBufferLoggerInterface', $buffer);
        $this->assertInstanceOf('Net\Bazzline\Component\Logger\TriggerBufferLogger', $buffer);
        $this->assertEquals(LogLevel::ERROR, $buffer->getTriggerToLogLevel());
    }
}
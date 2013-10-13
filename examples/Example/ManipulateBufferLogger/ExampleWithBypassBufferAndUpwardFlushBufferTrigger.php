<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-09-07 
 */

namespace Example\ManipulateBufferLogger;

use Net\Bazzline\Component\ProxyLogger\BufferManipulator\BypassBuffer;
use Net\Bazzline\Component\ProxyLogger\BufferManipulator\UpwardFlushBufferTrigger;
use Net\Bazzline\Component\ProxyLogger\Proxy\ManipulateBufferLogger;
use Net\Bazzline\Component\ProxyLogger\Factory\ManipulateBufferLoggerFactory;
use Net\Bazzline\Component\ProxyLogger\OutputToConsoleLogger;

require_once __DIR__ . '/../../../vendor/autoload.php';

ExampleWithBypassBufferAndUpwardFlushBufferTrigger::create()
    ->setup()
    ->andRun();

/**
 * Class ExampleWithBypassBufferAndUpwardFlushBufferTrigger
 *
 * @package Example\ManipulateBufferLogger
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-09-07
 */
class ExampleWithBypassBufferAndUpwardFlushBufferTrigger
{
    /**
     * @var \Net\Bazzline\Component\ProxyLogger\Proxy\ManipulateBufferLogger
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-09-07
     */
    private $logger;

    /**
     * @return ExampleWithBypassBuffer
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-09-07
     */
    public static function create()
    {
        return new self();
    }

    /**
     * @return $this
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-09-07
     */
    public function setup()
    {
        $bypassBuffer = new BypassBuffer();
        $logger = new OutputToConsoleLogger();
        $manipulateBufferLoggerFactory = new ManipulateBufferLoggerFactory();
        $flushBufferTrigger = new UpwardFlushBufferTrigger();
        $manipulateBufferLoggerFactory->setFlushBufferTrigger($flushBufferTrigger);
        $manipulateBufferLoggerFactory->setBypassBuffer($bypassBuffer);

        $this->logger = $manipulateBufferLoggerFactory->create($logger);

        return $this;
    }

    /**
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-09-07
     */
    public function andRun()
    {
        echo str_repeat('-', 40) . PHP_EOL;
        echo 'Setting trigger to error' . PHP_EOL;
        $this->logger
            ->getFlushBufferTrigger()
            ->setTriggerToError();
        echo 'Setting bypass buffer level to Notice' . PHP_EOL;
        $this->logger
            ->getBypassBuffer()
            ->addBypassForLevelNotice();
        echo str_repeat('-', 40) . PHP_EOL;
        echo 'Adding logging messages' . PHP_EOL;
        $this->logger->notice('Current line is ' . __LINE__);
        $this->logger->info('Current line is ' . __LINE__);
        $this->logger->notice('Current line is ' . __LINE__);
        $this->logger->warning('Current line is ' . __LINE__);
        $this->logger->critical('Current line is ' . __LINE__);
        $this->logger->notice('Current line is ' . __LINE__);
        $this->logger->info('Current line is ' . __LINE__);
        echo str_repeat('-', 40) . PHP_EOL;
        echo 'Flush buffer' . PHP_EOL;
        $this->logger->flush();
        echo str_repeat('-', 40) . PHP_EOL;
    }
}
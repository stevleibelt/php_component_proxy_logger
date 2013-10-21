<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-08-28
 */

namespace Example\ManipulateBufferLogger;

use Net\Bazzline\Component\ProxyLogger\Factory\ManipulateBufferLoggerFactory;
use Net\Bazzline\Component\ProxyLogger\Factory\NeverBypassBufferFactory;
use Net\Bazzline\Component\ProxyLogger\Factory\FlushBufferTriggerFactory;
use Net\Bazzline\Component\ProxyLogger\OutputToConsoleLogger;

require_once __DIR__ . '/../../../vendor/autoload.php';

Example::create()
    ->setup()
    ->andRun();

/**
 * Class Example
 *
 * @package Example\BufferLogger
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-08-28
 */
class Example
{
    /**
     * @var \Net\Bazzline\Component\ProxyLogger\Proxy\ManipulateBufferLogger
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-28
     */
    private $logger;

    /**
     * @return Example
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-28
     */
    public static function create()
    {
        return new self();
    }

    /**
     * @return $this
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-28
     */
    public function setup()
    {
        $bypassBufferFactory = new NeverBypassBufferFactory();
        $bypassBuffer = $bypassBufferFactory->create();
        $flushBufferTriggerFactory = new FlushBufferTriggerFactory();
        $flushBufferTrigger = $flushBufferTriggerFactory->create();
        $logger = new OutputToConsoleLogger();
        $manipulateBufferLoggerFactory = new ManipulateBufferLoggerFactory();
        $manipulateBufferLoggerFactory->setFlushBufferTriggerFactory($flushBufferTrigger);
        $manipulateBufferLoggerFactory->setBypassBufferFactory($bypassBuffer);

        $this->logger = $manipulateBufferLoggerFactory->create($logger);

        return $this;
    }

    /**
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-28
     */
    public function andRun()
    {
        echo str_repeat('-', 40) . PHP_EOL;
        echo 'Setting trigger to critical' . PHP_EOL;
        $this->logger->getFlushBufferTrigger()->setTriggerToCritical();
        echo str_repeat('-', 40) . PHP_EOL;
        echo 'Adding logging messages' . PHP_EOL;
        $this->logger->info('Current line is ' . __LINE__);
        $this->logger->alert('Current line is ' . __LINE__);
        $this->logger->critical('Current line is ' . __LINE__);
        $this->logger->info('Current line is ' . __LINE__);
        echo str_repeat('-', 40) . PHP_EOL;
        echo 'Flush buffer' . PHP_EOL;
        $this->logger->flush();
        echo str_repeat('-', 40) . PHP_EOL;
    }
}
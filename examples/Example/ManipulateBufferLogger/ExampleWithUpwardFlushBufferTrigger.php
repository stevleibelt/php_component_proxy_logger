<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-08-28
 */

namespace Example\ManipulateBufferLogger;

use Net\Bazzline\Component\ProxyLogger\Factory\LogRequestFactory;
use Net\Bazzline\Component\ProxyLogger\Factory\LogRequestRuntimeBufferFactory;
use Net\Bazzline\Component\ProxyLogger\Factory\ManipulateBufferLoggerFactory;
use Net\Bazzline\Component\ProxyLogger\Factory\UpwardFlushBufferTriggerFactory;
use Net\Bazzline\Component\ProxyLogger\OutputToConsoleLogger;

require_once __DIR__ . '/../../../vendor/autoload.php';

ExampleWithUpwardFlushBufferTrigger::create()
    ->setup()
    ->andRun();

/**
 * Class Example
 *
 * @package Example\ManipulateBufferLogger
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-08-28
 */
class ExampleWithUpwardFlushBufferTrigger
{
    /**
     * @var \Net\Bazzline\Component\ProxyLogger\Proxy\ManipulateBufferLogger
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-28
     */
    private $logger;

    /**
     * @return ExampleWithUpwardFlushBufferTrigger
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
        $logger = new OutputToConsoleLogger();
        $logRequestFactory = new LogRequestFactory();
        $logRequestBufferFactory = new LogRequestRuntimeBufferFactory();
        $manipulateBufferLoggerFactory = new ManipulateBufferLoggerFactory();
        $flushBufferTriggerFactory = new UpwardFlushBufferTriggerFactory();
        $manipulateBufferLoggerFactory->setLogRequestFactory($logRequestFactory);
        $manipulateBufferLoggerFactory->setLogRequestBufferFactory($logRequestBufferFactory);
        $manipulateBufferLoggerFactory->setFlushBufferTriggerFactory($flushBufferTriggerFactory);

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
        echo 'Setting trigger to warning' . PHP_EOL;
        $this->logger
            ->getFlushBufferTrigger()
            ->setTriggerToWarning();
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

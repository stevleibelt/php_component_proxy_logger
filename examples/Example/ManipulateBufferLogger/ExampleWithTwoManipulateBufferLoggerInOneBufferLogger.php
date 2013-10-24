<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-10-24 
 */

namespace Example\ManipulateBufferLogger;

use Example\ManipulateBufferLogger\Helper\MailLogRequestFactory;
use Example\ManipulateBufferLogger\Helper\WakeUpCallLogRequestFactory;
use Net\Bazzline\Component\ProxyLogger\Factory\ProxyLoggerFactory;
use Net\Bazzline\Component\ProxyLogger\Factory\UpwardFlushBufferTriggerFactory;
use Net\Bazzline\Component\ProxyLogger\Factory\LogRequestRuntimeBufferFactory;
use Net\Bazzline\Component\ProxyLogger\Factory\ManipulateBufferLoggerFactory;
use Net\Bazzline\Component\ProxyLogger\Proxy\BufferLoggerInterface;
use Net\Bazzline\Component\ProxyLogger\OutputToConsoleLogger;

require_once __DIR__ . '/../../../vendor/autoload.php';

ExampleWithTwoManipulateBufferLoggerInOneBufferLogger::create()
    ->setup()
    ->andRun();

/**
 * Class ExampleWithTwoManipulateBufferLoggerInOneBufferLogger
 *
 * @package Example\ManipulateBufferLogger
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-10-24
 */
class ExampleWithTwoManipulateBufferLoggerInOneBufferLogger
{
    /**
     * @var \Net\Bazzline\Component\ProxyLogger\Proxy\ManipulateBufferLogger
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-10-24
     */
    private $logger;

    /**
     * @return ExampleWithTwoManipulateBufferLoggerInOneBufferLogger
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-10-24
     */
    public static function create()
    {
        return new self();
    }

    /**
     * @return $this
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-10-24
     */
    public function setup()
    {
        $flushBufferTriggerFactory = new UpwardFlushBufferTriggerFactory();
        $realLoggerOne = new OutputToConsoleLogger();
        $realLoggerTwo = new OutputToConsoleLogger();
        $mailLogRequestFactory = new MailLogRequestFactory();
        $wakeUpCallLogRequestFactory = new WakeUpCallLogRequestFactory();
        $logRequestBufferFactory = new LogRequestRuntimeBufferFactory();
        $proxyLoggerFactory = new ProxyLoggerFactory();
        $manipulateBufferLoggerFactory = new ManipulateBufferLoggerFactory();
        $manipulateBufferLoggerFactory->setLogRequestFactory($mailLogRequestFactory);
        $manipulateBufferLoggerFactory->setLogRequestBufferFactory($logRequestBufferFactory);
        $manipulateBufferLoggerFactory->setFlushBufferTriggerFactory($flushBufferTriggerFactory);

        $mailLogger = $manipulateBufferLoggerFactory->create($realLoggerOne);
        $mailLogger->getFlushBufferTrigger()->setTriggerToCritical();

        $manipulateBufferLoggerFactory->setLogRequestFactory($wakeUpCallLogRequestFactory);

        $wakeUpCallLogger = $manipulateBufferLoggerFactory->create($realLoggerTwo);
        $wakeUpCallLogger->getFlushBufferTrigger()->setTriggerToAlert();

        $loggerCollection = $proxyLoggerFactory->create($mailLogger);
        $loggerCollection->addLogger($wakeUpCallLogger);

        $this->logger = $loggerCollection;

        return $this;
    }

    /**
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-10-24
     */
    public function andRun()
    {
        echo str_repeat('-', 40) . PHP_EOL;
        echo 'First run - adding info and error messages' . PHP_EOL;
        echo PHP_EOL;
        $this->logger->info('Current line is ' . __LINE__);
        $this->logger->error('Current line is ' . __LINE__);
        $this->logger->info('Current line is ' . __LINE__);
        echo str_repeat('-', 40) . PHP_EOL;
        echo 'cleaning log buffer' . PHP_EOL;
        $this->cleanLogBuffer();
        echo str_repeat('-', 40) . PHP_EOL;
        echo 'Second run - adding info, error and critical messages' . PHP_EOL;
        echo PHP_EOL;
        $this->logger->info('Current line is ' . __LINE__);
        $this->logger->error('Current line is ' . __LINE__);
        $this->logger->critical('Current line is ' . __LINE__);
        $this->logger->info('Current line is ' . __LINE__);
        echo str_repeat('-', 40) . PHP_EOL;
        echo 'cleaning log buffer' . PHP_EOL;
        $this->cleanLogBuffer();
        echo str_repeat('-', 40) . PHP_EOL;
        echo 'Third run - adding info, error, critical and alert messages' . PHP_EOL;
        echo PHP_EOL;
        $this->logger->info('Current line is ' . __LINE__);
        $this->logger->error('Current line is ' . __LINE__);
        $this->logger->critical('Current line is ' . __LINE__);
        $this->logger->info('Current line is ' . __LINE__);
        $this->logger->alert('Current line is ' . __LINE__);
        echo str_repeat('-', 40) . PHP_EOL;
    }

    /**
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-10-24
     */
    private function cleanLogBuffer()
    {
        foreach ($this->logger as $logger) {
            if ($logger instanceof BufferLoggerInterface) {
                $logger->clean();
            }
        }
    }
}

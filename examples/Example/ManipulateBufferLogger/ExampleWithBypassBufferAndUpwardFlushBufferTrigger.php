<?php
/**
 * @author stev leibelt <artodeto@bazzline.net>
 * @since 2013-09-07 
 */

namespace Example\ManipulateBufferLogger;

use Net\Bazzline\Component\ProxyLogger\Factory\LogRequestFactory;
use Net\Bazzline\Component\ProxyLogger\Factory\LogRequestRuntimeBufferFactory;
use Net\Bazzline\Component\ProxyLogger\Factory\BypassBufferFactory;
use Net\Bazzline\Component\ProxyLogger\Factory\ManipulateBufferLoggerFactory;
use Net\Bazzline\Component\ProxyLogger\Factory\UpwardFlushBufferTriggerFactory;
use Net\Bazzline\Component\ProxyLogger\Logger\OutputToConsoleLogger;

require_once __DIR__ . '/../../../vendor/autoload.php';

ExampleWithBypassBufferAndUpwardFlushBufferTrigger::create()
    ->setup()
    ->andRun();

/**
 * Class ExampleWithBypassBufferAndUpwardFlushBufferTrigger
 *
 * @package Example\ManipulateBufferLogger
 * @author stev leibelt <artodeto@bazzline.net>
 * @since 2013-09-07
 */
class ExampleWithBypassBufferAndUpwardFlushBufferTrigger
{
    /**
     * @var \Net\Bazzline\Component\ProxyLogger\Logger\BufferLogger
     * @author stev leibelt <artodeto@bazzline.net>
     * @since 2013-09-07
     */
    private $bufferLogger;

    /**
     * @return ExampleWithBypassBuffer
     * @author stev leibelt <artodeto@bazzline.net>
     * @since 2013-09-07
     */
    public static function create()
    {
        return new self();
    }

    /**
     * @return $this
     * @author stev leibelt <artodeto@bazzline.net>
     * @since 2013-09-07
     */
    public function setup()
    {
        $bypassBufferFactory = new BypassBufferFactory();
        $logger = new OutputToConsoleLogger();
        $logRequestFactory = new LogRequestFactory();
        $logRequestBufferFactory = new LogRequestRuntimeBufferFactory();
        $manipulateBufferLoggerFactory = new ManipulateBufferLoggerFactory();
        $flushBufferTriggerFactory = new UpwardFlushBufferTriggerFactory();
        $manipulateBufferLoggerFactory->setLogRequestFactory($logRequestFactory);
        $manipulateBufferLoggerFactory->setLogRequestBufferFactory($logRequestBufferFactory);
        $manipulateBufferLoggerFactory->setFlushBufferTriggerFactory($flushBufferTriggerFactory);
        $manipulateBufferLoggerFactory->setBypassBufferFactory($bypassBufferFactory);

        $this->bufferLogger = $manipulateBufferLoggerFactory->create($logger);

        return $this;
    }

    /**
     * @author stev leibelt <artodeto@bazzline.net>
     * @since 2013-09-07
     */
    public function andRun()
    {
        echo str_repeat('-', 40) . PHP_EOL;
        echo 'Setting trigger to error' . PHP_EOL;
        $this->bufferLogger
            ->getEvent()
            ->getFlushBufferTrigger()
            ->setTriggerToError();
        echo 'Setting bypass buffer level to Notice' . PHP_EOL;
        $this->bufferLogger
            ->getEvent()
            ->getBypassBuffer()
            ->addBypassForLevelNotice();
        echo str_repeat('-', 40) . PHP_EOL;
        echo 'Adding logging messages' . PHP_EOL;
        $this->bufferLogger->notice('Current line is ' . __LINE__);
        $this->bufferLogger->info('Current line is ' . __LINE__);
        $this->bufferLogger->notice('Current line is ' . __LINE__);
        $this->bufferLogger->warning('Current line is ' . __LINE__);
        $this->bufferLogger->critical('Current line is ' . __LINE__);
        $this->bufferLogger->notice('Current line is ' . __LINE__);
        $this->bufferLogger->info('Current line is ' . __LINE__);
        echo str_repeat('-', 40) . PHP_EOL;
        echo 'Flush buffer' . PHP_EOL;
        $this->bufferLogger->flush();
        echo str_repeat('-', 40) . PHP_EOL;
    }
}
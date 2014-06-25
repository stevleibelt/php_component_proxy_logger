<?php
/**
 * @author stev leibelt <artodeto@bazzline.net>
 * @since 2013-08-28
 */

namespace Example\ManipulateBufferLogger;

use Net\Bazzline\Component\ProxyLogger\Factory\FlushBufferTriggerFactory;
use Net\Bazzline\Component\ProxyLogger\Factory\LogRequestFactory;
use Net\Bazzline\Component\ProxyLogger\Factory\LogRequestRuntimeBufferFactory;
use Net\Bazzline\Component\ProxyLogger\Factory\ManipulateBufferLoggerFactory;
use Net\Bazzline\Component\ProxyLogger\Factory\NeverBypassBufferFactory;
use Net\Bazzline\Component\ProxyLogger\Logger\OutputToConsoleLogger;

require_once __DIR__ . '/../../../vendor/autoload.php';

Example::create()
    ->setup()
    ->andRun();

/**
 * Class Example
 *
 * @package Example\ManipulateBufferLogger
 * @author stev leibelt <artodeto@bazzline.net>
 * @since 2013-08-28
 */
class Example
{
    /**
     * @var \Net\Bazzline\Component\ProxyLogger\Logger\BufferLogger
     * @author stev leibelt <artodeto@bazzline.net>
     * @since 2013-08-28
     */
    private $bufferLogger;

    /**
     * @return Example
     * @author stev leibelt <artodeto@bazzline.net>
     * @since 2013-08-28
     */
    public static function create()
    {
        return new self();
    }

    /**
     * @return $this
     * @author stev leibelt <artodeto@bazzline.net>
     * @since 2013-08-28
     */
    public function setup()
    {
        $bypassBufferFactory = new NeverBypassBufferFactory();
        $flushBufferTriggerFactory = new FlushBufferTriggerFactory();
        $logger = new OutputToConsoleLogger();
        $logRequestFactory = new LogRequestFactory();
        $logRequestBufferFactory = new LogRequestRuntimeBufferFactory();
        $manipulateBufferLoggerFactory = new ManipulateBufferLoggerFactory();
        $manipulateBufferLoggerFactory->setLogRequestFactory($logRequestFactory);
        $manipulateBufferLoggerFactory->setLogRequestBufferFactory($logRequestBufferFactory);
        $manipulateBufferLoggerFactory->setFlushBufferTriggerFactory($flushBufferTriggerFactory);
        $manipulateBufferLoggerFactory->setBypassBufferFactory($bypassBufferFactory);

        $this->bufferLogger = $manipulateBufferLoggerFactory->create($logger);

        return $this;
    }

    /**
     * @author stev leibelt <artodeto@bazzline.net>
     * @since 2013-08-28
     */
    public function andRun()
    {
        echo str_repeat('-', 40) . PHP_EOL;
        echo 'Setting trigger to critical' . PHP_EOL;
        $this->bufferLogger
            ->getEvent()
            ->getFlushBufferTrigger()
            ->setTriggerToCritical();
        echo str_repeat('-', 40) . PHP_EOL;
        echo 'Adding logging messages' . PHP_EOL;
        $this->bufferLogger->info('Current line is ' . __LINE__);
        $this->bufferLogger->alert('Current line is ' . __LINE__);
        $this->bufferLogger->critical('Current line is ' . __LINE__);
        $this->bufferLogger->info('Current line is ' . __LINE__);
        echo str_repeat('-', 40) . PHP_EOL;
        echo 'Flush buffer' . PHP_EOL;
        $this->bufferLogger->flush();
        echo str_repeat('-', 40) . PHP_EOL;
    }
}

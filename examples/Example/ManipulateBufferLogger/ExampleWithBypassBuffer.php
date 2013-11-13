<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-09-07
 */

namespace Example\ManipulateBufferLogger;

use Net\Bazzline\Component\ProxyLogger\Factory\LogRequestFactory;
use Net\Bazzline\Component\ProxyLogger\Factory\LogRequestRuntimeBufferFactory;
use Net\Bazzline\Component\ProxyLogger\Factory\ManipulateBufferLoggerFactory;
use Net\Bazzline\Component\ProxyLogger\Factory\BypassBufferFactory;
use Net\Bazzline\Component\ProxyLogger\Proxy\OutputToConsoleLogger;

require_once __DIR__ . '/../../../vendor/autoload.php';

ExampleWithBypassBuffer::create()
    ->setup()
    ->andRun();

/**
 * Class Example
 *
 * @package Example\ManipulateBufferLogger
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-09-07
 */
class ExampleWithBypassBuffer
{
    /**
     * @var \Net\Bazzline\Component\ProxyLogger\Proxy\BufferLogger
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-09-07
     */
    private $bufferLogger;

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
        $bypassBufferFactory = new BypassBufferFactory();
        $logger = new OutputToConsoleLogger();
        $logRequestFactory = new LogRequestFactory();
        $logRequestBufferFactory = new LogRequestRuntimeBufferFactory();
        $manipulateBufferLoggerFactory = new ManipulateBufferLoggerFactory();
        $manipulateBufferLoggerFactory->setLogRequestFactory($logRequestFactory);
        $manipulateBufferLoggerFactory->setLogRequestBufferFactory($logRequestBufferFactory);
        $manipulateBufferLoggerFactory->setBypassBufferFactory($bypassBufferFactory);

        $this->bufferLogger = $manipulateBufferLoggerFactory->create($logger);

        return $this;
    }

    /**
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-09-07
     */
    public function andRun()
    {
        echo str_repeat('-', 40) . PHP_EOL;
        echo 'Setting bypass buffer level to info' . PHP_EOL;
        $this->bufferLogger
            ->getEvent()
            ->getBypassBuffer()
            ->addBypassForLogLevelInfo();
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

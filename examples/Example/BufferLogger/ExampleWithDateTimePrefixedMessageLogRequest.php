<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-08-28
 */

namespace Example\BufferLogger;

use Net\Bazzline\Component\ProxyLogger\Proxy\BufferLogger;
use Net\Bazzline\Component\ProxyLogger\Factory\BufferLoggerFactory;
use Net\Bazzline\Component\ProxyLogger\Factory\LogRequestFactory;
use Net\Bazzline\Component\ProxyLogger\Factory\LogRequestRuntimeBufferFactory;
use Net\Bazzline\Component\ProxyLogger\OutputToConsoleLogger;

require_once __DIR__ . '/../../../vendor/autoload.php';

ExampleWithDateTimePrefixedMessageLogRequest::create()
    ->setup()
    ->andRun();

/**
 * Class Example
 *
 * @package Example\BufferLoggerWithDateTimePrefixedMessageLogRequest
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-08-29
 */
class ExampleWithDateTimePrefixedMessageLogRequest
{
    /**
     * @var \Net\Bazzline\Component\ProxyLogger\Proxy\BufferLogger
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-29
     */
    private $bufferLogger;

    /**
     * @return ExampleWithDateTimePrefixedMessageLogRequest
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-29
     */
    public static function create()
    {
        return new self();
    }

    /**
     * @return $this
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-29
     */
    public function setup()
    {
        $bufferLoggerFactory = new BufferLoggerFactory();
        $logRequestFactory = new LogRequestFactory();
        $logRequestFactory->setLogRequestClassName('DateTimePrefixedMessageLogRequest');
        $logRequestBufferFactory = new LogRequestRuntimeBufferFactory();
        $logger = new OutputToConsoleLogger();
        $this->bufferLogger = $bufferLoggerFactory->create($logger, $logRequestFactory, $logRequestBufferFactory);

        return $this;
    }

    /**
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-29
     */
    public function andRun()
    {
        echo str_repeat('-', 40) . PHP_EOL;
        echo 'Adding logging messages' . PHP_EOL;
        $this->bufferLogger->info('Current line is ' . __LINE__);
        $this->bufferLogger->alert('Current line is ' . __LINE__);
        $this->bufferLogger->critical('Current line is ' . __LINE__);
        echo str_repeat('-', 40) . PHP_EOL;
        echo 'Flush buffer' . PHP_EOL;
        $this->bufferLogger->flush();
        echo str_repeat('-', 40) . PHP_EOL;
    }
}
<?php
/**
 * @author stev leibelt <artodeto@bazzline.net>
 * @since 2013-08-28
 */

namespace Example\BufferLogger;

use Net\Bazzline\Component\ProxyLogger\Logger\BufferLogger;
use Net\Bazzline\Component\ProxyLogger\Factory\BufferLoggerFactory;
use Net\Bazzline\Component\ProxyLogger\Factory\DateTimePrefixedMessageLogRequestFactory;
use Net\Bazzline\Component\ProxyLogger\Factory\LogRequestRuntimeBufferFactory;
use Net\Bazzline\Component\ProxyLogger\Logger\OutputToConsoleLogger;

require_once __DIR__ . '/../../../vendor/autoload.php';

ExampleWithDateTimePrefixedMessageLogRequest::create()
    ->setup()
    ->andRun();

/**
 * Class Example
 *
 * @package Example\BufferLogger
 * @author stev leibelt <artodeto@bazzline.net>
 * @since 2013-08-29
 */
class ExampleWithDateTimePrefixedMessageLogRequest
{
    /**
     * @var \Net\Bazzline\Component\ProxyLogger\Logger\BufferLogger
     * @author stev leibelt <artodeto@bazzline.net>
     * @since 2013-08-29
     */
    private $bufferLogger;

    /**
     * @return ExampleWithDateTimePrefixedMessageLogRequest
     * @author stev leibelt <artodeto@bazzline.net>
     * @since 2013-08-29
     */
    public static function create()
    {
        return new self();
    }

    /**
     * @return $this
     * @author stev leibelt <artodeto@bazzline.net>
     * @since 2013-08-29
     */
    public function setup()
    {
        $bufferLoggerFactory = new BufferLoggerFactory();
        $logger = new OutputToConsoleLogger();
        $logRequestFactory = new DateTimePrefixedMessageLogRequestFactory();
        $logRequestBufferFactory = new LogRequestRuntimeBufferFactory();
        $bufferLoggerFactory->setLogRequestFactory($logRequestFactory);
        $bufferLoggerFactory->setLogRequestBufferFactory($logRequestBufferFactory);

        $this->bufferLogger = $bufferLoggerFactory->create($logger);

        return $this;
    }

    /**
     * @author stev leibelt <artodeto@bazzline.net>
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
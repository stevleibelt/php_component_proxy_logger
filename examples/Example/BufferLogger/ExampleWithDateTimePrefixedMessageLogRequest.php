<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-08-28
 */

namespace Example\BufferLogger;

use Net\Bazzline\Component\Logger\Proxy\BufferLogger;
use Net\Bazzline\Component\Logger\Factory\LogRequestFactory;
use Net\Bazzline\Component\Logger\Factory\LogRequestRuntimeBufferFactory;
use Net\Bazzline\Component\Logger\OutputToConsoleLogger;

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
     * @var \Net\Bazzline\Component\Logger\Proxy\BufferLogger
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-29
     */
    private $logger;

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
        $this->logger = new BufferLogger();
        $requestFactory = new LogRequestFactory();
        $requestFactory->setLogRequestClassName('DateTimePrefixedMessageLogRequest');
        $bufferFactory = new LogRequestRuntimeBufferFactory();
        $logger = new OutputToConsoleLogger();
        $this->logger->setLogRequestFactory($requestFactory);
        $this->logger->setLogRequestBufferFactory($bufferFactory);
        $this->logger->addLogger($logger);

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
        $this->logger->info('Current line is ' . __LINE__);
        $this->logger->alert('Current line is ' . __LINE__);
        $this->logger->critical('Current line is ' . __LINE__);
        echo str_repeat('-', 40) . PHP_EOL;
        echo 'Flush buffer' . PHP_EOL;
        $this->logger->flush();
        echo str_repeat('-', 40) . PHP_EOL;
    }
}
<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-08-28
 */

namespace Example\BufferLogger;

use Net\Bazzline\Component\ProxyLogger\Factory\BufferLoggerFactory;
use Net\Bazzline\Component\ProxyLogger\Factory\LogRequestFactory;
use Net\Bazzline\Component\ProxyLogger\Factory\LogRequestRuntimeBufferFactory;
use Net\Bazzline\Component\ProxyLogger\Proxy\OutputToConsoleLogger;
use Net\Bazzline\Component\ProxyLogger\Proxy\BufferLoggerInterface;

require_once __DIR__ . '/../../../vendor/autoload.php';

ExampleWithBufferLoggerInBufferLogger::create()
    ->setup()
    ->andRun();

/**
 * Class Example
 *
 * @package Example\BufferLogger
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-08-28
 */
class ExampleWithBufferLoggerInBufferLogger
{
    /**
     * @var \Net\Bazzline\Component\ProxyLogger\Proxy\BufferLoggerInterface
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-28
     */
    private $bufferLogger;

    /**
     * @return ExampleWithBufferLoggerInBufferLogger
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
        $bufferLoggerFactory = new BufferLoggerFactory();
        $logRequestFactory = new LogRequestFactory();
        $logRequestBufferFactory = new LogRequestRuntimeBufferFactory();
        $bufferLoggerFactory->setLogRequestFactory($logRequestFactory);
        $bufferLoggerFactory->setLogRequestBufferFactory($logRequestBufferFactory);
        $logger = new OutputToConsoleLogger();

        $innerBufferLogger = $bufferLoggerFactory->create($logger);
        $this->bufferLogger = $bufferLoggerFactory->create($innerBufferLogger);

        return $this;
    }

    /**
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-28
     */
    public function andRun()
    {
        echo str_repeat('-', 40) . PHP_EOL;
        echo 'Adding logging messages' . PHP_EOL;
        $this->bufferLogger->info('Current line is ' . __LINE__);
        $this->bufferLogger->alert('Current line is ' . __LINE__);
        $this->bufferLogger->critical('Current line is ' . __LINE__);
        echo str_repeat('-', 40) . PHP_EOL;
        echo 'Flush buffer of outer logger' . PHP_EOL;
        $this->bufferLogger->flush();
        echo 'Flush buffer of inner logger' . PHP_EOL;
        foreach ($this->bufferLogger->getLoggers() as $logger) {
            if ($logger instanceof BufferLoggerInterface) {
                $logger->flush();
            }
        }
        echo str_repeat('-', 40) . PHP_EOL;
    }
}
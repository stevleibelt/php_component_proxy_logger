<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-08-28
 */

namespace Example\ProxyLogger;

use Net\Bazzline\Component\ProxyLogger\Factory\ProxyLoggerFactory;
use Net\Bazzline\Component\ProxyLogger\Logger\OutputToConsoleLogger;

require_once __DIR__ . '/../../../vendor/autoload.php';

ExampleWithProxyLoggerInProxyLogger::create()
    ->setup()
    ->andRun();

/**
 * Class ExampleWithProxyLoggerInProxyLogger
 *
 * @package Example\ProxyLogger
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-08-28
 */
class ExampleWithProxyLoggerInProxyLogger
{
    /**
     * @var \Net\Bazzline\Component\ProxyLogger\Logger\ProxyLogger
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-28
     */
    private $logger;

    /**
     * @return ExampleWithTwoLoggers
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
        $factory = new ProxyLoggerFactory();
        $loggerOne = new OutputToConsoleLogger();
        $loggerTwo = new OutputToConsoleLogger();

        $innerProxyLogger = $factory->create($loggerOne);
        $this->logger = $factory->create($innerProxyLogger);
        $this->logger->addLogger($loggerTwo);

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
        echo str_repeat('-', 40) . PHP_EOL;
        $this->logger->info('Current line is ' . __LINE__);
        $this->logger->alert('Current line is ' . __LINE__);
        $this->logger->critical('Current line is ' . __LINE__);
        echo str_repeat('-', 40) . PHP_EOL;
    }
}
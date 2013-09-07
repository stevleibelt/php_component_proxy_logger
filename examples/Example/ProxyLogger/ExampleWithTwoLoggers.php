<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-08-28
 */

namespace Example\ProxyLogger;

use Net\Bazzline\Component\ProxyLogger\Proxy\ProxyLogger;
use Net\Bazzline\Component\ProxyLogger\OutputToConsoleLogger;

require_once __DIR__ . '/../../../vendor/autoload.php';

ExampleWithTwoLoggers::create()
    ->setup()
    ->andRun();

/**
 * Class Example
 *
 * @package Example\ProxyLogger
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-08-28
 */
class ExampleWithTwoLoggers
{
    /**
     * @var \Net\Bazzline\Component\ProxyLogger\Proxy\ProxyLogger
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
        $this->logger = new ProxyLogger();
        $loggerOne = new OutputToConsoleLogger();
        $loggerTwo = new OutputToConsoleLogger();
        $this->logger->addLogger($loggerOne);
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
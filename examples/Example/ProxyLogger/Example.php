<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 8/28/13
 */

namespace Example\ProxyLogger;

use Net\Bazzline\Component\Logger\ProxyLogger;
use Net\Bazzline\Component\Logger\OutputToConsoleLogger;

require_once __DIR__ . '/../../../vendor/autoload.php';

Example::create()
    ->setup()
    ->andRun();

/**
 * Class Example
 *
 * @package Example\ProxyLogger
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-08-28
 */
class Example
{
    /**
     * @var \Net\Bazzline\Component\Logger\ProxyLogger
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-28
     */
    private $logger;

    /**
     * @return Example
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
        $logger = new OutputToConsoleLogger();
        $this->logger->setLogger($logger);

        return $this;
    }

    /**
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-28
     */
    public function andRun()
    {
        echo str_repeat('-', 40) . PHP_EOL;
        $this->logger->info('Current line is ' . __LINE__);
        $this->logger->alert('Current line is ' . __LINE__);
        $this->logger->critical('Current line is ' . __LINE__);
        echo str_repeat('-', 40) . PHP_EOL;
    }
}
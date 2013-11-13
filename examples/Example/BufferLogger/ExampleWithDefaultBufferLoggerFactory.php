<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-08-28
 */

namespace Example\BufferLogger;

use Net\Bazzline\Component\ProxyLogger\Factory\DefaultBufferLoggerFactory;
use Net\Bazzline\Component\ProxyLogger\Logger\OutputToConsoleLogger;

require_once __DIR__ . '/../../../vendor/autoload.php';

ExampleWithDefaultBufferLoggerFactory::create()
    ->setup()
    ->andRun();

/**
 * Class Example
 *
 * @package Example\BufferLogger
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-08-28
 */
class ExampleWithDefaultBufferLoggerFactory
{
    /**
     * @var \Net\Bazzline\Component\ProxyLogger\Logger\BufferLogger
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-28
     */
    private $bufferLogger;

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
        $bufferLoggerFactory = new DefaultBufferLoggerFactory();
        $logger = new OutputToConsoleLogger();

        $this->bufferLogger = $bufferLoggerFactory->create($logger);

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
        echo 'Flush buffer' . PHP_EOL;
        $this->bufferLogger->flush();
        echo str_repeat('-', 40) . PHP_EOL;
    }
}
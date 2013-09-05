<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 8/28/13
 */

namespace Example\BufferLogger;

use Net\Bazzline\Component\Logger\Proxy\BufferLogger;
use Net\Bazzline\Component\Logger\LogEntry\LogEntryFactory;
use Net\Bazzline\Component\Logger\LogEntry\LogEntryRuntimeBufferFactory;
use Net\Bazzline\Component\Logger\OutputToConsoleLogger;

require_once __DIR__ . '/../../../vendor/autoload.php';

ExampleWithDateTimePrefixedMessageLogEntry::create()
    ->setup()
    ->andRun();

/**
 * Class Example
 *
 * @package Example\BufferLoggerWithDateTimePrefixedMessageLogEntry
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-08-29
 */
class ExampleWithDateTimePrefixedMessageLogEntry
{
    /**
     * @var \Net\Bazzline\Component\Logger\Proxy\BufferLogger
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-29
     */
    private $logger;

    /**
     * @return ExampleWithDateTimePrefixedMessageLogEntry
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
        $entryFactory = new LogEntryFactory();
        $entryFactory->setLogEntryClassName('DateTimePrefixedMessageLogEntry');
        $bufferFactory = new LogEntryRuntimeBufferFactory();
        $logger = new OutputToConsoleLogger();
        $this->logger->setLogEntryFactory($entryFactory);
        $this->logger->setLogEntryBufferFactory($bufferFactory);
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
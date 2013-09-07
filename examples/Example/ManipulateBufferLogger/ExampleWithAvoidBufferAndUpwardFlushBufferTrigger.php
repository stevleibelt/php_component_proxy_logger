<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-09-07 
 */

namespace Example\ManipulateBufferLogger;

use Net\Bazzline\Component\Logger\BufferManipulation\AvoidBuffer;
use Net\Bazzline\Component\Logger\BufferManipulation\UpwardFlushBufferTrigger;
use Net\Bazzline\Component\Logger\Proxy\ManipulateBufferLogger;
use Net\Bazzline\Component\Logger\Factory\LogEntryFactory;
use Net\Bazzline\Component\Logger\Factory\LogEntryRuntimeBufferFactory;
use Net\Bazzline\Component\Logger\OutputToConsoleLogger;

require_once __DIR__ . '/../../../vendor/autoload.php';

ExampleWithAvoidBufferAndUpwardFlushBufferTrigger::create()
    ->setup()
    ->andRun();

class ExampleWithAvoidBufferAndUpwardFlushBufferTrigger
{
    /**
     * @var \Net\Bazzline\Component\Logger\Proxy\ManipulateBufferLogger
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-09-07
     */
    private $logger;

    /**
     * @return ExampleWithAvoidBuffer
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
        $this->logger = new ManipulateBufferLogger();
        $entryFactory = new LogEntryFactory();
        $entryFactory->setLogEntryClassName('LogEntry');
        $bufferFactory = new LogEntryRuntimeBufferFactory();
        $logger = new OutputToConsoleLogger();
        $this->logger->setLogEntryFactory($entryFactory);
        $this->logger->setLogEntryBufferFactory($bufferFactory);
        $this->logger->addLogger($logger);
        $this->logger->setBypassBuffer(new AvoidBuffer());
        $this->logger->setFlushBufferTrigger(new UpwardFlushBufferTrigger());

        return $this;
    }

    /**
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-09-07
     */
    public function andRun()
    {
        echo str_repeat('-', 40) . PHP_EOL;
        echo 'Setting trigger to error' . PHP_EOL;
        $this->logger
            ->getFlushBufferTrigger()
            ->setTriggerToError();
        echo 'Setting avoid level to Notice' . PHP_EOL;
        $this->logger
            ->getBypassBuffer()
            ->addAvoidableNoticeLogLevel();
        echo str_repeat('-', 40) . PHP_EOL;
        echo 'Adding logging messages' . PHP_EOL;
        $this->logger->notice('Current line is ' . __LINE__);
        $this->logger->info('Current line is ' . __LINE__);
        $this->logger->notice('Current line is ' . __LINE__);
        $this->logger->warning('Current line is ' . __LINE__);
        $this->logger->critical('Current line is ' . __LINE__);
        $this->logger->notice('Current line is ' . __LINE__);
        $this->logger->info('Current line is ' . __LINE__);
        echo str_repeat('-', 40) . PHP_EOL;
        echo 'Flush buffer' . PHP_EOL;
        $this->logger->flush();
        echo str_repeat('-', 40) . PHP_EOL;
    }
}
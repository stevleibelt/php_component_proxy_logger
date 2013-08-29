<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 8/28/13
 */

namespace Example\TriggerBufferLoggerWithInheritanceMap;

use Net\Bazzline\Component\Logger\TriggerBufferLogger;
use Net\Bazzline\Component\Logger\LogEntryFactory;
use Net\Bazzline\Component\Logger\LogEntryRuntimeBufferFactory;
use Net\Bazzline\Component\Logger\OutputToConsoleLogger;

require_once __DIR__ . '/../../../vendor/autoload.php';

ExampleWithLogLevelTriggerInheritanceDefaultMap::create()
    ->setup()
    ->andRun();

/**
 * Class Example
 *
 * @package Example\BufferLogger
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-08-28
 */
class ExampleWithLogLevelTriggerInheritanceDefaultMap
{
    /**
     * @var \Net\Bazzline\Component\Logger\TriggerBufferLogger
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-28
     */
    private $logger;

    /**
     * @return ExampleWithLogLevelTriggerInheritanceDefaultMap
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
        $this->logger = new TriggerBufferLogger();
        $entryFactory = new LogEntryFactory();
        $entryFactory->setLogEntryClassName('LogEntry');
        $bufferFactory = new LogEntryRuntimeBufferFactory();
        $map = require_once __DIR__ . '/../../../source/Net/Bazzline/Component/Logger/logLevelTriggerInheritanceDefaultMap.php';
        $logger = new OutputToConsoleLogger();
        $this->logger->injectLogEntryFactory($entryFactory);
        $this->logger->injectLogEntryBufferFactory($bufferFactory);
        $this->logger->addLogger($logger);
        $this->logger->setLogLevelTriggerInheritanceMap($map);

        return $this;
    }

    /**
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-28
     */
    public function andRun()
    {
        echo str_repeat('-', 40) . PHP_EOL;
        echo 'Setting trigger to warning' . PHP_EOL;
        $this->logger->setLogLevelTriggerToWarning();
        echo str_repeat('-', 40) . PHP_EOL;
        echo 'Adding logging messages' . PHP_EOL;
        $this->logger->info('Current line is ' . __LINE__);
        $this->logger->alert('Current line is ' . __LINE__);
        $this->logger->critical('Current line is ' . __LINE__);
        $this->logger->info('Current line is ' . __LINE__);
        echo str_repeat('-', 40) . PHP_EOL;
        echo 'Flush buffer' . PHP_EOL;
        $this->logger->flush();
        echo str_repeat('-', 40) . PHP_EOL;
    }
}
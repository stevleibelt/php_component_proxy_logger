<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 8/28/13
 */

namespace Example\TriggeredBufferLoggerWithInheritanceMap;

use Net\Bazzline\Component\Logger\TriggeredBufferLogger;
use Net\Bazzline\Component\Logger\LogEntryFactory;
use Net\Bazzline\Component\Logger\LogEntryRuntimeBufferFactory;
use Net\Bazzline\Component\Logger\OutputToConsoleLogger;

require_once __DIR__ . '/../../../vendor/autoload.php';

Example::create()
    ->setup()
    ->andRun();

/**
 * Class Example
 *
 * @package Example\BufferedLogger
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-08-28
 */
class Example
{
    /**
     * @var \Net\Bazzline\Component\Logger\TriggeredBufferLogger
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
        $this->logger = new TriggeredBufferLogger();
        $entryFactory = new LogEntryFactory();
        $bufferFactory = new LogEntryRuntimeBufferFactory();
        $map = require_once __DIR__ . '/../../../source/Net/Bazzline/Component/Logger/triggeredLogLevelInheritanceDefaultMap.php';
        $logger = new OutputToConsoleLogger();
        $this->logger->injectLogEntryFactory($entryFactory);
        $this->logger->injectLogEntryBufferFactory($bufferFactory);
        $this->logger->setLogger($logger);
        $this->logger->setTriggeredLogLevelInheritanceMap($map);

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
        $this->logger->setTriggerToLogLevelWarning();
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
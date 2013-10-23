<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-10-03
 */

namespace Example\ManipulateBufferLogger;

use Net\Bazzline\Component\ProxyLogger\Factory\LogRequestFactory;
use Net\Bazzline\Component\ProxyLogger\Factory\ManipulateBufferLoggerFactory;
use Net\Bazzline\Component\ProxyLogger\Factory\UpwardFlushBufferTriggerFactory;
use Net\Bazzline\Component\ProxyLogger\OutputToConsoleLogger;
use Psr\Log\LogLevel;

require_once __DIR__ . '/../../../vendor/autoload.php';

ExampleWithUpwardFlushBufferTriggerVersusNormalLogger::create()
    ->setup()
    ->andRun();

/**
 * Class ExampleWithUpwardFlushBufferTriggerVersusNormalLogger
 *
 * @package Example\ManipulateBufferLogger
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-10-03
 */
class ExampleWithUpwardFlushBufferTriggerVersusNormalLogger
{
    /**
     * @var \Net\Bazzline\Component\ProxyLogger\Proxy\ManipulateBufferLogger
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-10-03
     */
    private $manipulateBufferLogger;

    /**
     * @var \Net\Bazzline\Component\ProxyLogger\OutputToConsoleLogger
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-10-03
     */
    private $normalLogger;

    /**
     * @return ExampleWithUpwardFlushBufferTrigger
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-10-03
     */
    public static function create()
    {
        return new self();
    }

    /**
     * @return $this
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-10-03
     */
    public function setup()
    {
        $logger = new OutputToConsoleLogger();
        $logRequestFactory = new LogRequestFactory();
        $manipulateBufferLoggerFactory = new ManipulateBufferLoggerFactory();
        $flushBufferTriggerFactory = new UpwardFlushBufferTriggerFactory();
        $manipulateBufferLoggerFactory->setLogRequestFactory($logRequestFactory);
        $manipulateBufferLoggerFactory->setFlushBufferTriggerFactory($flushBufferTriggerFactory);

        $this->manipulateBufferLogger = $manipulateBufferLoggerFactory->create($logger);
        $this->normalLogger = new OutputToConsoleLogger();

        return $this;
    }

    /**
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-10-03
     */
    public function andRun()
    {
        echo str_repeat('-', 40) . PHP_EOL;
        echo 'Setting trigger to warning' . PHP_EOL;
        $this->manipulateBufferLogger
            ->getFlushBufferTrigger()
            ->setTriggerToWarning();

        $preparedMessagesWithLogLevelsPerItemToProcess = array(
            'process id 1' => array(
                'processing id 1' => LogLevel::DEBUG,
                'collection information and data id: 1' => LogLevel::INFO,
                'done' => LogLevel::DEBUG
            ),
            'processing id 2' => array(
                'processing id 3' => LogLevel::DEBUG,
                'collection information and data id: 3' => LogLevel::INFO,
                'data can not handled with this process, queueing data to manual processing list' => LogLevel::INFO,
                'done' => LogLevel::DEBUG
            ),
            'processing id 3' => array(
                'processing id 8' => LogLevel::DEBUG,
                'collection information and data id: 8' => LogLevel::INFO,
                'logical problem in data on key 3' => LogLevel::INFO,
                'trying to recalculate data' => LogLevel::NOTICE,
                'setting data value of key 7 to default' => LogLevel::INFO,
                'finished' => LogLevel::DEBUG
            ),
            'process id 4' => array(
                'processing id 4' => LogLevel::DEBUG,
                'collection information and data id: 4' => LogLevel::INFO,
                'done' => LogLevel::DEBUG
            ),
            'processing id 5' => array(
                'processing id 5' => LogLevel::DEBUG,
                'collection information and data id: 5' => LogLevel::INFO,
                'logical problem in data on key 6' => LogLevel::INFO,
                'trying to recalculate data' => LogLevel::NOTICE,
                'setting data value of key 7 to default not possible' => LogLevel::WARNING,
                'trying to revert modification' => LogLevel::NOTICE,
                'runtime data and data in storage differs, can not revert modification' => LogLevel::ERROR,
                'lost connection to storage' => LogLevel::CRITICAL,
                'can not unlock and schedule processing to id 5' => LogLevel::ALERT,
                'done' => LogLevel::DEBUG
            ),
            'processing id 6' => array(
                'processing id 6' => LogLevel::DEBUG,
                'lost connection to storage' => LogLevel::CRITICAL,
                'can not unlock and schedule processing to id 6' => LogLevel::ALERT,
                'done' => LogLevel::DEBUG
            )
        );

        echo str_repeat('-', 40) . PHP_EOL;
        echo 'First run with normal logger without log level restriction.' . PHP_EOL;
        echo str_repeat('-', 40) . PHP_EOL;

        foreach ($preparedMessagesWithLogLevelsPerItemToProcess as $messagesWithLogLevels) {
            foreach ($messagesWithLogLevels as $message => $logLevel) {
                $this->normalLogger->$logLevel($message);
            }
        }

        echo str_repeat('-', 40) . PHP_EOL;
        echo 'Second run with normal logger and log level restriction to warning and above.' . PHP_EOL;
        echo str_repeat('-', 40) . PHP_EOL;

        $allowedLogLevels = array(
            LogLevel::WARNING => true,
            LogLevel::ERROR => true,
            LogLevel::CRITICAL => true,
            LogLevel::ALERT => true,
            LogLevel::EMERGENCY => true
        );

        foreach ($preparedMessagesWithLogLevelsPerItemToProcess as $messagesWithLogLevels) {
            foreach ($messagesWithLogLevels as $message => $logLevel) {
                if (isset($allowedLogLevels[$logLevel])) {
                    $this->normalLogger->$logLevel($message);
                }
            }
        }

        echo str_repeat('-', 40) . PHP_EOL;
        echo 'Third run with manipulate buffer logger.' . PHP_EOL;
        echo str_repeat('-', 40) . PHP_EOL;

        foreach ($preparedMessagesWithLogLevelsPerItemToProcess as $messagesWithLogLevels) {
            foreach ($messagesWithLogLevels as $message => $logLevel) {
                $this->manipulateBufferLogger->$logLevel($message);
            }
            $this->manipulateBufferLogger->clean();
        }
    }
}
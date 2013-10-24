<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-10-24 
 */

namespace Example\ManipulateBufferLogger;

use Example\ManipulateBufferLogger\Helper\MailLogRequestFactory;
use Example\ManipulateBufferLogger\Helper\WakeUpCallLogRequestFactory;
use Net\Bazzline\Component\ProxyLogger\Factory\ProxyLoggerFactory;
use Net\Bazzline\Component\ProxyLogger\Factory\UpwardFlushBufferTriggerFactory;
use Net\Bazzline\Component\ProxyLogger\Factory\LogRequestRuntimeBufferFactory;
use Net\Bazzline\Component\ProxyLogger\Factory\ManipulateBufferLoggerFactory;
use Net\Bazzline\Component\ProxyLogger\OutputToConsoleLogger;

require_once __DIR__ . '/../../../vendor/autoload.php';

ExampleWithTwoManipulateBufferLoggerInOneProxyLogger::create()
    ->setup()
    ->andRun();

/**
 * Class ExampleWithTwoManipulateBufferLoggerInOneProxyLogger
 *
 * @package Example\ManipulateBufferLogger
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-10-24
 */
class ExampleWithTwoManipulateBufferLoggerInOneProxyLogger
{
    /**
     * @var \Net\Bazzline\Component\ProxyLogger\Proxy\ManipulateBufferLogger
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-10-24
     */
    private $logger;

    /**
     * @return ExampleWithTwoManipulateBufferLoggerInOneProxyLogger
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-10-24
     */
    public static function create()
    {
        return new self();
    }

    /**
     * @return $this
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-10-24
     */
    public function setup()
    {
        $flushBufferTriggerFactory = new UpwardFlushBufferTriggerFactory();
        $realLoggerOne = new OutputToConsoleLogger();
        $realLoggerTwo = new OutputToConsoleLogger();
        $mailLogRequestFactory = new MailLogRequestFactory();
        $wakeUpCallLogRequestFactory = new WakeUpCallLogRequestFactory();
        $logRequestBufferFactory = new LogRequestRuntimeBufferFactory();
        $proxyLoggerFactory = new ProxyLoggerFactory();
        $manipulateBufferLoggerFactory = new ManipulateBufferLoggerFactory();
        $manipulateBufferLoggerFactory->setLogRequestFactory($mailLogRequestFactory);
        $manipulateBufferLoggerFactory->setLogRequestBufferFactory($logRequestBufferFactory);
        $manipulateBufferLoggerFactory->setFlushBufferTriggerFactory($flushBufferTriggerFactory);

        $mailLogger = $manipulateBufferLoggerFactory->create($realLoggerOne);
        $mailLogger->getFlushBufferTrigger()->setTriggerToCritical();

        $manipulateBufferLoggerFactory->setLogRequestFactory($wakeUpCallLogRequestFactory);

        $wakeUpCallLogger = $manipulateBufferLoggerFactory->create($realLoggerTwo);
        $wakeUpCallLogger->getFlushBufferTrigger()->setTriggerToAlert();

        $loggerCollection = $proxyLoggerFactory->create($mailLogger);
        $loggerCollection->addLogger($wakeUpCallLogger);

        $this->logger = $loggerCollection;

        return $this;
    }

    /**
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-10-24
     */
    public function andRun()
    {

    }
}

<?php
/**
 * @author stev leibelt <artodeto@bazzline.net>
 * @since 2013-10-23 
 */

namespace Example\Documentation;

use Net\Bazzline\Component\ProxyLogger\Factory\LogRequestFactory;
use Net\Bazzline\Component\ProxyLogger\Factory\LogRequestRuntimeBufferFactory;
use Net\Bazzline\Component\ProxyLogger\Factory\ManipulateBufferLoggerFactory;
use Net\Bazzline\Component\ProxyLogger\Factory\UpwardFlushBufferTriggerFactory;
use Net\Bazzline\Component\ProxyLogger\Logger\OutputToConsoleLogger;
use Psr\Log\LogLevel;

/**
 * @author stev leibelt <artodeto@bazzline.net>
 * @since 2013-09-09
 */

//easy up autoloading by using composer autoloader
require_once __DIR__ . '/../../../vendor/autoload.php';

//create a psr3 logger
$innerLogger = new OutputToConsoleLogger();

//create the trigger
$triggerFactory = new UpwardFlushBufferTriggerFactory();
//set trigger to log level \Psr\Log\LogLevel::ERROR
$triggerFactory->setTriggerToLogLevel(LogLevel::ERROR);

$logRequestFactory = new LogRequestFactory();
$logRequestBufferFactory = new LogRequestRuntimeBufferFactory();

//use factory to create manipulate buffer logger
$factory = new ManipulateBufferLoggerFactory();
$factory->setLogRequestFactory($logRequestFactory);
$factory->setLogRequestBufferFactory($logRequestBufferFactory);
$factory->setFlushBufferTriggerFactory($triggerFactory);
$logger = $factory->create($innerLogger);

//log request is added to the buffer
$logger->info('this is an info message');
//log request is added to the buffer
$logger->debug('a debug information');
//buffer flush is triggered
$logger->error('the server made a boo boo');

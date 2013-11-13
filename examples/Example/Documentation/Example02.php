<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-10-23 
 */

namespace Example\Documentation;

use Net\Bazzline\Component\ProxyLogger\Factory\BypassBufferFactory;
use Net\Bazzline\Component\ProxyLogger\Factory\LogRequestFactory;
use Net\Bazzline\Component\ProxyLogger\Factory\LogRequestRuntimeBufferFactory;
use Net\Bazzline\Component\ProxyLogger\Factory\ManipulateBufferLoggerFactory;
use Net\Bazzline\Component\ProxyLogger\Logger\OutputToConsoleLogger;
use Psr\Log\LogLevel;

/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-09-09
 */

//easy up autoloading by using composer autoloader
require_once __DIR__ . '/../../../vendor/autoload.php';

//create a psr3 logger
$innerLogger = new OutputToConsoleLogger();

//create bypass
$bypassBufferFactory = new BypassBufferFactory();
//set log Level \Psr\Log\LogLevel::INFO to bypass
$bypassBufferFactory->setLogLevelsToBypass(array(LogLevel::INFO));

//use factory to create manipulate buffer logger
$loggerFactory = new ManipulateBufferLoggerFactory();
$loggerFactory->setLogRequestFactory(new LogRequestFactory());
$loggerFactory->setLogRequestBufferFactory(new LogRequestRuntimeBufferFactory());
$loggerFactory->setBypassBufferFactory($bypassBufferFactory);
$logger = $loggerFactory->create($innerLogger);

//log request is added to the buffer
$logger->info('this is an info message');
//log request is passed to all added real loggers
$logger->debug('a debug information');
//log request is added to the buffer
$logger->error('the server made a boo boo');
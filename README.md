# Logger Proxy Component

This component ships a collection of enhanced proxy logger handling tools.

The build status of the current master branch is tracked by Travis CI:
[![Build Status](https://travis-ci.org/stevleibelt/php_component_proxy_logger.png?branch=master)](http://travis-ci.org/stevleibelt/php_component_proxy_logger)

The main idea is to use a proxy with a buffer for one or a collection of [PSR-3 logger](https://github.com/php-fig/log) to add freedom and silence back to your log files.

# Features

* full [PSR-3 Logger Interface](https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-3-logger-interface.md) compatibility
* allows you define when log messages are pushed to your loggers
* only logs if configured log level is reached
* regains freedom and silence in your log files
* use the proxy logger component to combine management of multiple loggers

# Common Terms

* *RealLogger* represents a logger that implements the psr-3 logger interface and who is added to a *ProxyLogger*
* *LogRequest* represents a log request (including log level, message and context)
* *LogRequestBuffer* represents a collection of log requests that are not pushed to the real loggers
* *ProxyLogger* represents a collection of real loggers
* *BufferLogger* represents as a log request keeper that pass each log request to a buffer and pushs all buffered log request to all added real loggers when *flush* is called
* *ManipulateBufferLogger* represents an enhanced BufferLogger to use *BypassBufferInterface* and/or *FlushBufferTriggerInterface*
* *BypassBufferInterface* represents a buffer manipulation to bypass a certain log level to all added real loggers
* *FlushBufferTriggerInterface* represents a buffer manipulation to trigger a buffer flush based on a log level

# Components

## Available Proxy Logger Interfaces

### ProxyLoggerInterface

* simple proxy that needs at least one real logger to work
* implements PSR-3 LoggerInterface
* real PSR-3 Logger has to be injected
* pass-through logging requests to all added real loggers

### BufferLoggerInterface

* based on *ProxyLoggerInterface*
* stores each log request into an buffer that implements the *LogRequestBufferInterface*
* forwards all buffered log requests to all added real loggers when *flush* is called
* deletes all buffered log requests when *clean* is called

### ManipulateBufferLoggerInterface

* based on *BufferLoggerInterface*
* implements aware interface for *FlushBufferTriggerInterface* which enables automatically buffer flushing if a well defined log level is reached
* implements aware interface for *BypassBufferInterface* which enables mechanism to bypass the buffer and send the log requests directly to the available real loggers

## BufferManipulation

### BypassBufferInterface

* adds opportunity to define log levels (*addBypassForLogLevel*) to bypass log requests from the buffer and pass this requests directory to all added real loggers
* provides method *bypassBuffer* to check if log level should be bypassed from the buffer
* implemented by:
    * AlwaysBypassBuffer
    * BypassBuffer
    * NeverBypassBuffer

## FlushBufferTriggerInterface

* adds opportunity to set a trigger (*setTriggerTo*) for a log level that should trigger to flush the buffer
* provides method *triggerBufferFlush* to check if log level should trigger a buffer flush
* implemented by:
    * AbstractFlushBufferTrigger
    * AlwaysFlushBufferTrigger
    * FlushBufferTrigger
    * NeverFlushBufferTrigger
    * UpwardFlushBufferTrigger

## Factory

### LogRequestBufferFactoryInterface

* provides method *create* to return a *LogRequestBufferInterface* object
* implemented by *LogRequestRuntimeBufferFactory*

### LogRequestFactoryInterface

* provides method *create* to return a *LogRequestInterface* object
* implemented by *LogRequestFactory*

### ProxyLoggerFactoryInterface

* provides method *create* to return a *ProxyLoggerInterface* object
* implemented by *ProxyLoggerFactory*

### BufferLoggerFactoryInterface

* provides method *create* to return a *BufferLoggerInterface* object
* implemented by *BufferLoggerFactory*

### ManipulateBufferLoggerFactoryInterface

* provides method *create* to return a *ManipulateBufferLoggerInterface* object
* implemented by *ManipulateBufferLoggerFactory*

## LogRequest

### LogRequestInterface

* defines a log request that could be stored in a buffer
* represents the general log request with properties *log level*, *message* and *context*
* implemented by:
    * LogRequest
    * DateTimePrefixedMessageLogRequest

### LogRequestBufferInterface

* defines methods to handle a collection of log requests
* defines method *count*
* can be used to implement a file based buffer
* can be used to implement a database based buffer
* can be used to implement a session based buffer
* implemented by *LogRequestRuntimeBuffer*

## Validator

### IsValidLogLevelInterface

* can be injected by implementing the *IsValidLogLevelAwareInterface*
* based on [component_requirement](https://packagist.org/packages/net_bazzline/component_requirement)
* validates if provided log level fits into defined [PSR-3 log levels](https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-3-logger-interface.md)

## Additional Code

### LoggerAwareInterface

* extends *\Psr\Logger\LoggerAwareInterface*
* provides methods *getLogger* and *hasLogger*

### OutputToConsoleLogger

* implements *\Psr\Logger\LoggerInterface*
* prints formated log request to console

### DateTimePrefixedMessageLogRequest

* implements *LogRequestInterface*
* prefix the log request message with a date time (format 'Y-m-d H:i:s')

### LogRequestRuntimeBuffer

* implements *LogRequestBufferInterface*
* buffers all log requests for the time of instantiation

# Installation

## [GitHub](https://github.com/stevleibelt/php_component_proxy_logger)

    mkdir -p $HOME/path/to/my/repositories/php_component_proxy_logger
    cd $HOME/path/to/my/repositories/php_component
    git clone https://github.com/stevleibelt/php_component_proxy_logger .

## [Composer](https://packagist.org/packages/net_bazzline/component_proxy_logger)

    require: "net_bazzline/component_proxy_logger": "dev-master"

# Migration Tutorial

For the sake of simplicity, i assume you have a LoggerFactory you are calling whenever you need a new Logger.

```php
<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-09-09
 */

/**
 * Factory for creating loggers
 */
class MyLoggerFactory
{
    /**
     * @return \Psr\Log\LoggerInterface
     */
    public function createMyProcessLogger()
    {
        return new Logger();
    }
}
```

All you have to do is to adapt your create method the following way (as an example).

```php
<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-09-09
 */

use \Net\Bazzline\Component\ProxyLogger\Factory\ProxyLoggerFactory();

/**
 * Factory for creating loggers
 */
class MyLoggerFactory
{
    /**
     * @return \Psr\Log\LoggerInterface
     */
    public function createMyProcessLogger()
    {
        $realLogger = new Logger();

        //of course this should not be done on each create call
        $proxyLoggerFactory = new ProxyLoggerFactory();
        $proxyLogger = $proxyLoggerFactory->create($realLogger);
    
        return $proxyLogger;
    }
}
```

Thats it! Since all proxy loggers are implementing the *\Psr\Log\LoggerInterface*, the whole proxy is fully transparent and all your code will work as before.

# Example Code

This component is shipped with a lot of [examples](https://github.com/stevleibelt/php_component_proxy_logger/tree/master/examples/Example), so take a look inside. All examples can be called on the command line like 'php examples/Example/BufferLogger/Example.php'.

## Create A Buffer Logger That Flushs The Buffer If Log Level Error Or Above Is Used

```php
<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-09-09
 */

use Net\Bazzline\Component\ProxyLogger\BufferManipulation\UpwardFlushBufferTrigger;
use Net\Bazzline\Component\ProxyLogger\Factory\ManipulateBufferLoggerFactory;

//craete a psr3 logger
$logger = MyPSR3Logger();

//create the trigger
$flushBuffer = UpwardFlushBufferTrigger();
//set trigger to log level \Psr\Log\LogLevel::ERROR
$flushBuffer->setTriggerToError();

//use factory to create manipulate buffer logger
$bufferLogger = new ManipulateBufferLoggerFactory($logger, $flushBuffer);

//log request is added to the buffer
$bufferLogger->info('this is an info message');
//log request is added to the buffer
$bufferLogger->debug('a debug information');
//buffer flush is triggered
$bufferLogger->error('the server made a boo boo');
```

## Create A Buffer Logger That Bypass Configured Log Requests From Buffer

```php
<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-09-09
 */

use Net\Bazzline\Component\ProxyLogger\BufferManipulation\BypassBuffer;
use Net\Bazzline\Component\ProxyLogger\Factory\ManipulateBufferLoggerFactory;

//craete a psr3 logger
$logger = MyPSR3Logger();

//create bypass
$bypassBuffer = new BypassBuffer();
//set log Level \Psr\Log\LogLevel::INFO to bypass
$bypassBuffer->addBypassForLogLevelInfo();

//use factory to create manipulate buffer logger
$bufferLogger = new ManipulateBufferLoggerFactory($logger, null, $bypassBuffer);

//log request is added to the buffer
$bufferLogger->info('this is an info message');
//log request is passed to all added real loggers
$bufferLogger->debug('a debug information');
//log request is added to the buffer
$bufferLogger->error('the server made a boo boo');
```

## Use Buffer Logger Inside A Process That Iterates Over A Collection Of Items

```php
<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-09-09
 */

use Net\Bazzline\Component\ProxyLogger\Factory\BufferLoggerFactory;
use Net\Bazzline\Component\ProxyLogger\Factory\LogRequestFactory;
use Net\Bazzline\Component\ProxyLogger\Factory\LogRequestBufferFactory;

//it is assumed that a logger is returned, that implements the \Psr\Log\LoggerInterface
$realLogger = $this->getMyLogger();
$logRequestFactory = new LogRequestFactory();
$logRequestBufferFactory = new LogRequestBufferFactory();
$bufferLoggerFactory = BufferLoggerFactory($realLogger, $logRequestFactory, $logRequestBufferFactory);

$bufferLogger = $bufferLoggerFactory->create();

//it is assumed that a collection object or a plain array with items is returned
$collectionOfItemsToProcess = $this->getCollectionOfItemsToProcess();

//it is assumed that a class is returned, that can handle a item from the collection of items
//it is assumed that a class is returned, that implements the LoggerAwareInterface
//it is assumed that a class throws an RuntimeException if a item could not be processed
$itemProcessor = $this->getItemProcessor();
$itemProcessor->setLogger($bufferLogger);

//this example shows the benefit of reclaimed silence and freedom on your log
//only if something happens, log requests are send to your logger
foreach ($collectionOfItemsToProcess as $itemToProcess) {
    try {
        $itemProcessor->setItem($itemToProcess);
        $itemProcessor->execute();
        //clean log buffer if nothing happens
        $itemProcessor->getLogger()->clean();
    } catch (RuntimeException $exception) {
        //add exception message as log request to the buffer
        $itemProcessor->getLogger()->error($exception->getMessage());
        //flush buffer to the real logger to debug what has happen
        $itemProcessor->getLogger()->flush();
    }
}

```

## Use Manipulate Buffer Logger Inside A Process That Iterates Over A Collection Of Items And Log All Info Log Requests

```php
<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-09-09
 */

use Net\Bazzline\Component\ProxyLogger\Factory\ManipulateBufferLoggerFactory;
use Net\Bazzline\Component\ProxyLogger\Factory\LogRequestFactory;
use Net\Bazzline\Component\ProxyLogger\Factory\LogRequestBufferFactory;
use Net\Bazzline\Component\ProxyLogger\BufferManipulation\BypassBuffer;

//it is assumed that a logger is returned, that implements the \Psr\Log\LoggerInterface
$realLogger = $this->getMyLogger();
$logRequestFactory = new LogRequestFactory();
$logRequestBufferFactory = new LogRequestBufferFactory();
$bypassBuffer = new BypassBuffer();

//enable bypass for log requests with log level info
$bypassBuffer->addBypassForLogLevelInfo();
$manipulateBufferLoggerFactory = ManipulateBufferLoggerFactory($realLogger, $logRequestFactory, $logRequestBufferFactory);
$manipulateBufferLogger = $bufferLoggerFactory->create();

//it is assumed that a collection object or a plain array with items is returned
$collectionOfItemsToProcess = $this->getCollectionOfItemsToProcess();

//it is assumed that a class is returned, that can handle a item from the collection of items
//it is assumed that a class is returned, that implements the LoggerAwareInterface
//it is assumed that a class throws an RuntimeException if a item could not be processed
$itemProcessor = $this->getItemProcessor();
$itemProcessor->setLogger($manipulateBufferLogger);

//this example shows the benefit of using the bypass buffer manipulation
//you are not losing the info log level requests but all other except a RuntimeException is thrown
foreach ($collectionOfItemsToProcess as $itemToProcess) {
    try {
        $itemProcessor->getLogger()->info(
            'processing item with id: ' . $itemToProcess->getId()
        );
        $itemProcessor->setItem($itemToProcess);
        $itemProcessor->execute();
        //clean log buffer if nothing happens
        $itemProcessor->getLogger()->clean();
    } catch (RuntimeException $exception) {
        //add exception message as log request to the buffer
        $itemProcessor->getLogger()->error($exception->getMessage());
        //flush buffer to the real logger to debug what has happen
        $itemProcessor->getLogger()->flush();
    }
}

```

# Links

## PSR-3 Logger

Following an uncompleted list of available PSR3-Logger components.

* [talkback](https://github.com/chrisnoden/talkback)

# Licence

This software is licenced under [GNU LESSER GENERAL PUBLIC LICENSE](https://www.gnu.org/copyleft/lesser.html).   
The full licence text is shipped [within](https://github.com/stevleibelt/php_component_proxy_logger/blob/master/LICENSE) this component package.

# Version History

* [next](https://github.com/stevleibelt/php_component_proxy_logger)
    * declare *LogRequestFactoryInterface* and *LogRequestBufferFactoryInterface* as optional for factory *BufferLoggerFactoryInterface*
* [1.0.0](https://github.com/stevleibelt/php_component_proxy_logger/tree/1.0.0)
    * big refactoring to easy up trigger and bypass handling for buffer manipulation
    * renamed LogEntry to LogRequest
    * restructured project
    * added a lot more example
    * add threshold level for ManipulateBufferLogger that enables the possibility to bypass the buffer for certain levels (by BypassBufferInterface)
* [0.9.0](https://github.com/stevleibelt/php_component_proxy_logger/tree/0.9.0)
    * TriggerBufferLogger - flushes the buffer by configured log level
    * BufferLogger - buffers log messages and provides *flush* or *clean* for buffer control
    * ProxyLogger - generic proxy class that is working internally with the injected the [PSR-3 logger](https://github.com/php-fig/log)
    * LogEntry class to use a [simple value object](http://en.wikipedia.org/wiki/Data_Transfer_Object)
    * LogEntryFactory to easy up LogRequest creation
    * LogEntryCollection for easy dealing with multiple LogEntries
    * IsValidLogLevel to validate if provided log level is meeting the LogLevel requirement as a well defined value
    * DefaultMap to trigger inherited log levels by only providing one log level

# Upcoming Features

* add description about benefits of using *UpwardFlushBufferTrigger*
* style output - if level is reached, wrap the buffer output with something like "==== log level buffer flush triggered ====" or "==== log level buffer bypassed ===="
* implement locking
* implement "unsetFlushBufferTrigger" to AwareInterface
* implement "unsetBypassBuffer" to AwareInterface
* submit idea to [log4php](https://logging.apache.org/log4php/)
    * [Contributin](http://wiki.apache.org/logging-log4php/Contributing)
    * [Installing](http://logging.apache.org/log4php/install.html)
    * [Volunteering](https://logging.apache.org/log4php/volunteering.html)
    * [How ASF works](http://www.apache.org/foundation/how-it-works.html)
    * [Subscribe Mailinglists](http://www.apache.org/foundation/mailinglists.html)
    * [Mailinglists](http://logging.apache.org/log4php/mail-lists.html)

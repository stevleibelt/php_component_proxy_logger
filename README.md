# Logger Proxy Component

This component ships a collection of enhanced proxy logger handling tools.

The build status of the current master branch is tracked by Travis CI:
[![Build Status](https://travis-ci.org/stevleibelt/php_component_logger.png?branch=master)](http://travis-ci.org/stevleibelt/php_component_logger)

The main idea is to use a proxy with a buffer for one or a collection of [PSR-3 logger](https://github.com/php-fig/log) to add freedom and silence back to your log files.

# Features

* full [PSR-3 Logger Interface](https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-3-logger-interface.md) compatibility
* allows you define when log messages are send to
* only logs if critical log level is triggered
* regains freedom and silence in your log files
* use the proxy logger component to combine management of multiple loggers

# Common Terms

* *LogRequest* represents a log request (including log level, message and context)
* *LogRequestBuffer* represents a collection of log requests
* *ProxyLogger* represents a collection of psr-3 loggers
* *BufferLogger* represents as a log request keeper that pass each log request to a buffer and pushs all buffered log request to all added psr-3 loggers when *flush* is called
* *ManipulateBufferLogger* represents a enhanced BufferLogger to use BypassBufferInterface and/or FlushBufferTriggerInterface
* *BypassBufferInterface* represents a buffer manipulation to bypass a certain log level to all added psr-3 loggers
* *FlushBufferTriggerInterface* represents a buffer manipulation to trigger a buffer flush based on a log level

# Components

## Available Proxy Logger Interfaces

### ProxyLoggerInterface

* simple proxy that needs at least one logger to work
* implements PSR-3 LoggerInterface
* real PSR-3 Logger has to be injected
* pass-through logging requests to all added loggers

### BufferLoggerInterface

* based on *ProxyLoggerInterface*
* stores each log request into an buffer that implements the *LogRequestBufferInterface*
* forwards all buffered log requests to all added loggers when *flush* is called
* deletes all buffered log requests when *clean* is called

### ManipulateBufferLoggerInterface

* based on *BufferLoggerInterface*
* implements aware interface for *FlushBufferTriggerInterface* which enables automatically buffer flushing if a well defined log level is reached
* implements aware interface for *BypassBufferInterface* which enables mechanism to bypass the buffer and send the lob message directly to the available real loggers

## BufferManipulation

### BypassBufferInterface

* adds opportunity to define log levels (*addBypassForLogLevel*) to bypass log requests from the buffer and pass this requests directory to all added loggers
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

### ManipulateBufferLoggerFactoryInterface

* provides method *create* to return a *ManipulateBufferLoggerFactoryInterface* object
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
* validates if provided log level fits into defined [PSR-3 log levels](https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-3-logger-interface.md

# Installation

## [GitHub](https://github.com/stevleibelt/php_component_logger)

    mkdir -p $HOME/path/to/my/repositories/php_component
    cd $HOME/path/to/my/repositories/php_component
    git clone https://github.com/stevleibelt/php_component_logger .

## [Composer](https://packagist.org/packages/net_bazzline/component_logger)

    require: "net_bazzline/component_logger": "dev-master"

# Links

## PSR-3 Logger

Following an uncompleted list of available PSR3-Logger components.

* [talkback](https://github.com/chrisnoden/talkback)

# Todo List

* update readme
    * show example with benefits of using buffer->flush or buffer->clean when you are in a process that iterates over a bunch of data
    * show migration example
    * show code examples

# Licence

This software is licenced under [GNU LESSER GENERAL PUBLIC LICENSE](https://www.gnu.org/copyleft/lesser.html). The full licence text is shipped [within](https://github.com/stevleibelt/php_component_logger/blob/master/LICENSE) this component package.

# Version History

* [next](https://github.com/stevleibelt/php_component_logger)
    * big refactoring to easy up trigger and bypass handling for buffer manipulation
    * renamed LogEntry to LogRequest
    * restructured project
    * added a lot more example
    * add threshold level for ManipulateBufferLogger that enables the possibility to bypass the buffer for certain levels (by BypassBufferInterface)
* [0.9.0](https://github.com/stevleibelt/php_component_logger/tree/0.9.0)
    * TriggerBufferLogger - flushes the buffer by configured log level
    * BufferLogger - buffers log messages and provides *flush* or *clean* for buffer control
    * ProxyLogger - generic proxy class that is working internally with the injected the [PSR-3 logger](https://github.com/php-fig/log)
    * LogEntry class to use a [simple value object](http://en.wikipedia.org/wiki/Data_Transfer_Object)
    * LogEntryFactory to easy up LogRequest creation
    * LogEntryCollection for easy dealing with multiple LogEntries
    * IsValidLogLevel to validate if provided log level is meeting the LogLevel requirement as a well defined value
    * DefaultMap to trigger inherited log levels by only providing one log level

# Upcoming Features

* style output - if level is reached, wrap the buffer output with something like "==== log level buffer flush triggered ====" or "==== log level buffer bypassed ===="
* implement locking
* implement "unsetFlushBufferTrigger" to AwareInterface
* implement "unsetBypassBuffer" to AwareInterface
* submit idea to [log4php](https://logging.apache.org/log4php/)

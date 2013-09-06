# Logger Component

This component ships a collection of enhanced logger handling tools.

The build status of the current master branch is tracked by Travis CI:
[![Build Status](https://travis-ci.org/stevleibelt/php_component_logger.png?branch=master)](http://travis-ci.org/stevleibelt/php_component_logger)

The main component is the *TriggerBufferLogger* which enables level triggered logging for each PSR-3 LoggerInterface.

# Features

* full [PSR-3 Logger Interface](https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-3-logger-interface.md) compatibility.
* only logs if critical log level is triggered
* regains freedom and silence in your log files

# Available Logger Components

## ProxyLogger

* simple proxy that needs a logger to work
* implements PSR-3 LoggerInterface
* real PSR-3 Logger has to be injected

## BufferLogger

* based on *ProxyLogger*
* stores each log message into buffer
* provides generic method to plug in any kind of log message buffer
* forwards all buffered messages to real logger when *flush* is called
* deletes all buffered messages when *clean* is called

## TriggerBufferLogger

* based on *BufferLogger*
* implements automatically flushing if log level is reached

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
    * explain storage aka LogEntryBufferInterface
    * show example with benefits of using buffer->flush or buffer->clean when you are in a process that iterates over a bunch of data
    * mention all decoupled classes and the benefit of that

# Licence

This software is licenced under [GNU LESSER GENERAL PUBLIC LICENSE](https://www.gnu.org/copyleft/lesser.html). The full licence text is shipped [within](https://github.com/stevleibelt/php_component_logger/blob/master/LICENSE) this component package.

# Version History

* [next](https://github.com/stevleibelt/php_component_logger)
    * big refactoring to easy up trigger and avoid handling for buffer manipulation
    * addd threshold level for TriggerBufferLogger that enables the possibility to bypass the buffer for certain levels (by AvoidBufferInterface)
* [0.9.0](https://github.com/stevleibelt/php_component_logger/tree/0.9.0)
    * TriggerBufferLogger - flushes the buffer by configured log level
    * BufferLogger - buffers log messages and provides *flush* or *clean* for buffer control
    * ProxyLogger - generic proxy class that is working internally with the injected the [PSR-3 logger](https://github.com/php-fig/log)
    * LogEntry class to use a [simple value object](http://en.wikipedia.org/wiki/Data_Transfer_Object)
    * LogEntryFactory to easy up LogEntry creation
    * LogEntryCollection for easy dealing with multiple LogEntries
    * IsValidLogLevel to validate if provided log level is meeting the LogLevel requirement as a well defined value
    * DefaultMap to trigger inherited log levels by only providing one log level

# Upcoming Features

* style output - if level is reached, wrap the buffer output with something like "==== log level buffer flush triggered ====" or "==== log level buffer avoided ===="
* implement locking
* implement "unsetTrigger"
* implement "unsetAvoidableLogLevel"
* submit idea to [log4php](https://logging.apache.org/log4php/)

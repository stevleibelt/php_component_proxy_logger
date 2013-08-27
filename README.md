# Logger Component

Enables level triggered logging for each psr-3 LoggerInterface.

# Main Idea

* collects all logger messages in memory
* if logging level is reached, collected messages are written in real logger, otherwise thrown away
* can handle each real logger that implements psr-3 logger interface

# Features

* full [PSR-3 Logger Interface](https://github.com/php-fig/fig-standards/blob/master/accepted/PSR-3-logger-interface.md) compatibility.
* only logs if critical log level is triggered
* regains freedom and silence in your log files

# Installation

## [GitHub](https://github.com/stevleibelt/php_component_logger)

    mkdir -p $HOME/path/to/my/repositories/php_component
    cd $HOME/path/to/my/repositories/php_component
    git clone https://github.com/stevleibelt/php_component_logger .

## [Composer](https://packagist.org/packages/net_bazzline/component_logger)

    require: "net_bazzline/component_logger": "dev-master"

# Links

## PSR-3 Logger

* [talkback](https://github.com/chrisnoden/talkback)

# Todo List

* create interface "injectStorage" or "StorageAwareInterface" (currently LogEntryCollectionInterface)
* add method "flush" to LogBuffer
* refactor AbstractProxyLogger to LogBuffer
* refactor TriggeredProxyLogger to ThresholdLogBuffer
* implement unittests
* implement "unsetTriggerLevel"
* implement locking
* evaluate if it make sense to move the InjectFactory interfaces to a full qualified AwareInterface

# Version History

* [next](https://github.com/stevleibelt/php_component_logger)
    * TriggeredBufferLogger - flushes the buffer by configured log level
    * BufferedLogger - buffers log messages and provides *flush* or *clean* for buffer control
    * ProxyLogger - generic proxy class that is working internally with the injected the [PSR-3 logger](https://github.com/php-fig/log)
    * LogEntry class to use a [simple value object](http://en.wikipedia.org/wiki/Data_Transfer_Object)
    * LogEntryFactory to easy up LogEntry creation
    * LogEntryCollection for easy dealing with multiple LogEntries
    * IsValidLogLevel to validate if provided log level is meeting the LogLevel requirement as a well defined value
    * DefaultMap to trigger inherited log levels by only providing one log level

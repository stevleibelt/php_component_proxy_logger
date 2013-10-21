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

# Links

## Documentation

* [Common Terms](https://github.com/stevleibelt/php_component_proxy_logger/blob/master/documentation/CommonTerms.md)
* [Components](https://github.com/stevleibelt/php_component_proxy_logger/blob/master/documentation/Components.md)
* [Installation](https://github.com/stevleibelt/php_component_proxy_logger/blob/master/documentation/Installation.md)
* [Migration Tutorial](https://github.com/stevleibelt/php_component_proxy_logger/blob/master/documentation/MigrationTutorial.md)
* [Examples](https://github.com/stevleibelt/php_component_proxy_logger/blob/master/documentation/Examples.md)

## PSR-3 Logger

Following an uncompleted list of available PSR3-Logger components.

* [Talkback](https://github.com/chrisnoden/talkback)
* [Logger](https://github.com/geoffroy-aubry/Logger)
* [Simple Logger](https://github.com/fguillot/simpleLogger)
* [Analog](https://github.com/jbroadway/analog)
* [Packagist Search For PSR-3](https://packagist.org/search/?tags=psr-3)

# Licence

This software is licenced under [GNU LESSER GENERAL PUBLIC LICENSE](https://www.gnu.org/copyleft/lesser.html).   
The full licence text is shipped [within](https://github.com/stevleibelt/php_component_proxy_logger/blob/master/LICENSE) this component package.

# Version History

* [next](https://github.com/stevleibelt/php_component_proxy_logger)
    * add example how to add a proxy logger in a proxy logger
    * add output of example flush buffer trigger logger versus normal logger to readme
    * adapt factories, replace all the parameters in the create call with some "setBufferClassName" methods
    * adapt factories added awareInterfaces to fitting buffer manipulators
    * readme examples are also provided as try out code example
    * replace AwareInterfaces with DependInterfaces where needed
    * update examples for buffer manipulator factories
* [1.1.0](https://github.com/stevleibelt/php_component_proxy_logger/tree/1.1.0) - not yet released
    * create factories for buffer manipulator
    * rename *BufferManipulation* to *BufferManipulator*
    * update factory section for buffer manipulator factories
* [1.0.4](https://github.com/stevleibelt/php_component_proxy_logger/tree/1.0.4) - released at 2013-10-05
    * refactor UpwardFlushBufferTrigger - replace complex array with numbers
* [1.0.3](https://github.com/stevleibelt/php_component_proxy_logger/tree/1.0.3) - released at 2013-10-04
    * add example that provides same logging code with and without proxy logger
* [1.0.2](https://github.com/stevleibelt/php_component_proxy_logger/tree/1.0.2) - released at 2013-09-11
    * fixed error in *ManipulateBufferLogger::flushTheBuffer*
* [1.0.1](https://github.com/stevleibelt/php_component_proxy_logger/tree/1.0.1) - released at 2013-09-10
    * declare *LogRequestFactoryInterface* and *LogRequestBufferFactoryInterface* as optional for factory *BufferLoggerFactoryInterface*
    * declare *LogRequestFactoryInterface* and *LogRequestBufferFactoryInterface* as optional for factory *ManipulateBufferLoggerFactoryInterface*
* [1.0.0](https://github.com/stevleibelt/php_component_proxy_logger/tree/1.0.0) - released at 2013-09-08
    * added a lot more example
    * added threshold level for ManipulateBufferLogger that enables the possibility to bypass the buffer for certain levels (by BypassBufferInterface)
    * big refactoring to easy up trigger and bypass handling for buffer manipulation
    * renamed LogEntry to LogRequest
    * restructured project
* [0.9.0](https://github.com/stevleibelt/php_component_proxy_logger/tree/0.9.0) - released at 2013-08-29
    * BufferLogger - buffers log messages and provides *flush* or *clean* for buffer control
    * DefaultMap to trigger inherited log levels by only providing one log level
    * IsValidLogLevel to validate if provided log level is meeting the LogLevel requirement as a well defined value
    * ProxyLogger - generic proxy class that is working internally with the injected the [PSR-3 logger](https://github.com/php-fig/log)
    * LogEntry class to use a [simple value object](http://en.wikipedia.org/wiki/Data_Transfer_Object)
    * LogEntryCollection for easy dealing with multiple LogEntries
    * LogEntryFactory to easy up LogRequest creation
    * TriggerBufferLogger - flushes the buffer by configured log level

# Future Thoughts

* think about using a numbers internal instead of log level arrays for validating if current log level is below or in (in the hierarchy point of view) the trigger
* add description about benefits of using *UpwardFlushBufferTrigger*
* add constants or well named setter methods for LogRequestFactoryInterface::setLogRequestClassName
* style output - if level is reached, wrap the buffer output with something like "==== log level buffer flush triggered ====" or "==== log level buffer bypassed ===="
* implement locking
* implement "unsetFlushBufferTrigger" to AwareInterface
* implement "unsetBypassBuffer" to AwareInterface
* validate if [monolog](https://github.com/Seldaek/monolog) is not doing the same thing
* submit idea to [log4php](https://logging.apache.org/log4php/)
    * [Contributing](http://wiki.apache.org/logging-log4php/Contributing)
    * [Installing](http://logging.apache.org/log4php/install.html)
    * [Volunteering](https://logging.apache.org/log4php/volunteering.html)
    * [How ASF works](http://www.apache.org/foundation/how-it-works.html)
    * [Subscribe Mailinglists](http://www.apache.org/foundation/mailinglists.html)
    * [Mailinglists](http://logging.apache.org/log4php/mail-lists.html)

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

## Available Events

### ProxyEvent

* The simplest event only used to trigger the "log log request" event

### BufferEvent

* Adds buffer specific events like "add log request to buffer", "clean buffer" or "flush buffer"

### ManipulateBufferEvent

* Adds setter and getter for all available buffer manipulators

## Available Event Listeners

### ProxyEventListener

* Handles the event to log a log request

### BufferEventListener

* Handles the available buffer event flow

### ManipulateBufferEventListener

* Extends the buffer concept a bit further by changing the event flow available buffer manipulators

## Buffer Manipulators

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
* implemented by *LogRequestFactory* and *DateTimePrefixedMessageLogRequestFactory*

### ProxyLoggerFactoryInterface

* provides method *create* to return a *ProxyLoggerInterface* object
* implemented by *ProxyLoggerFactory*

### BufferLoggerFactoryInterface

* provides method *create* to return a *BufferLoggerInterface* object
* implemented by *BufferLoggerFactory*

### ManipulateBufferLoggerFactoryInterface

* provides method *create* to return a *ManipulateBufferLoggerInterface* object
* implemented by *ManipulateBufferLoggerFactory*

### BypassBufferFactoryInterface

* provides method *create* to return a *BypassBufferInterface* object
* implemented by *AbstractBypassBufferFactory*, *AlwaysBypassBufferFactory*, *BypassBufferFactory* and *NeverBypassBufferFactory*

### FlushBufferTriggerFactoryInterface

* provides method *create* to return *FlushBufferTriggerinterface* object
* implemented by *AbstractFlushBufferTriggerFactory*, *AlwaysFlushBufferTriggerFactory*, *FlushBufferTriggerFactory*, *NeverFlushBufferTriggerFactory* and *UpwardFlushBufferTriggerFactory*

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

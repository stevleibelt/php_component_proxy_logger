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

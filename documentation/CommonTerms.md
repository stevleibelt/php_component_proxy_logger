# Common Terms

* *RealLogger* represents a logger that implements the psr-3 logger interface and who is added to a *ProxyLogger*
* *LogRequest* represents a log request (including log level, message and context)
* *LogRequestBuffer* represents a collection of log requests that are not pushed to the real loggers
* *ProxyLogger* represents a collection of real loggers
* *BufferLogger* represents as a log request keeper that pass each log request to a buffer and pushs all buffered log request to all added real loggers when *flush* is called
* *ManipulateBufferLogger* represents an enhanced BufferLogger to use *BypassBufferInterface* and/or *FlushBufferTriggerInterface*
* A *ManipulateBufferLogger* is a *BufferLogger* with an *ManipulateBufferEventListener* instead of a *BufferEventListener*
* The component is event driven
* *ProxyEvent*, *BufferEvent* and *ManipulateBufferEvent* are used by *ProxyEventListener*, *BufferEventListener* or *ManipulateBufferEventListener*
* *BypassBufferInterface* represents a buffer manipulation to bypass a certain log level to all added real loggers
* *FlushBufferTriggerInterface* represents a buffer manipulation to trigger a buffer flush based on a log level

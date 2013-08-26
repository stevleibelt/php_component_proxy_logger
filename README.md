# Log Level Triggered Logger

Enables level triggered logging for each psr-3 LoggerInterface.

## Main Idea

* collects all logger messages in memory
* if logging level is reached, collected messages are written in real logger, otherwise thrown away
* can handle each real logger that implements psr-3 logger interface

# Todo List

* implement "unsetTriggerLevel"
* implement locking

# Version History
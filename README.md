# Log Level Triggered Logger

Enables level triggered logging for each psr-3 LoggerInterface.

## Main Idea

* collects all logger messages in memory
* if logging level is reached, collected messages are written in real logger, otherwise thrown away
* can handle each real logger that implements psr-3 logger interface

# Todo List

* implement unittests
* fix author mail issue
* implement Logger::isTriggeredLogLevel that way, that it returns true if the log level is at least that important
    (log level "error" given and trigger level "warn" given, method will return true because warn is "as important as" warn)
* implement "trigger" method to overwrite setted trigger level
* implement "unsetTriggerLevel"
* implement locking

# Version History

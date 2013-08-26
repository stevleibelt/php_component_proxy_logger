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

## GitHub

    [git clone https://github.com/stevleibelt/php_component_logger .](https://github.com/stevleibelt/php_component_logger)

## Composer

    [require: "net_bazzline/component_logger": "dev-master"](https://packagist.org/packages/net_bazzline/component_logger)

# Todo List

* implement unittests
* implement "unsetTriggerLevel"
* implement locking

# Version History

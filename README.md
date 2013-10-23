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

# Licence

This software is licenced under [GNU LESSER GENERAL PUBLIC LICENSE](https://www.gnu.org/copyleft/lesser.html).
The full licence text is shipped [within](https://github.com/stevleibelt/php_component_proxy_logger/blob/master/LICENSE) this component package.

# Links

## Documentation

* [Common Terms](https://github.com/stevleibelt/php_component_proxy_logger/blob/master/documentation/CommonTerms.md)
* [Components](https://github.com/stevleibelt/php_component_proxy_logger/blob/master/documentation/Components.md)
* [Installation](https://github.com/stevleibelt/php_component_proxy_logger/blob/master/documentation/Installation.md)
* [Migration Tutorial](https://github.com/stevleibelt/php_component_proxy_logger/blob/master/documentation/MigrationTutorial.md)
* [Examples](https://github.com/stevleibelt/php_component_proxy_logger/blob/master/documentation/Examples.md)
* [Version History](https://github.com/stevleibelt/php_component_proxy_logger/blob/master/documentation/VersionHistory.md)
* [Future Thoughts](https://github.com/stevleibelt/php_component_proxy_logger/blob/master/documentation/FutureThoughts.md)

## PSR-3 Logger

Following an uncompleted list of available PSR3-Logger components.

* [Talkback](https://github.com/chrisnoden/talkback)
* [Logger](https://github.com/geoffroy-aubry/Logger)
* [Simple Logger](https://github.com/fguillot/simpleLogger)
* [Analog](https://github.com/jbroadway/analog)
* [Packagist Search For PSR-3](https://packagist.org/search/?tags=psr-3)

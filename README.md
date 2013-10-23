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

# Reason To Use This Component

Taken from the example [upward flush buffer trigger versus normal logger](https://github.com/stevleibelt/php_component_proxy_logger/blob/master/examples/Example/ManipulateBufferLogger/ExampleWithUpwardFlushBufferTriggerVersusNormalLogger.php).

This [example](https://github.com/stevleibelt/php_component_proxy_logger/blob/master/examples/Example) shows a process that is working on a collection of items.

The first run is simple *logging all information's*. This fills up your logs pretty fast.

```shell
----------------------------------------
Setting trigger to warning
----------------------------------------
First run with normal logger without log level restriction.
----------------------------------------
[1382566548] [debug] [processing id 1]
[1382566548] [info] [collection information and data id: 1]
[1382566548] [debug] [done]
[1382566548] [debug] [processing id 3]
[1382566548] [info] [collection information and data id: 3]
[1382566548] [info] [data can not handled with this process, queueing data to manual processing list]
[1382566548] [debug] [done]
[1382566548] [debug] [processing id 8]
[1382566548] [info] [collection information and data id: 8]
[1382566548] [info] [logical problem in data on key 3]
[1382566548] [notice] [trying to recalculate data]
[1382566548] [info] [setting data value of key 7 to default]
[1382566548] [debug] [finished]
[1382566548] [debug] [processing id 4]
[1382566548] [info] [collection information and data id: 4]
[1382566548] [debug] [done]
[1382566548] [debug] [processing id 5]
[1382566548] [info] [collection information and data id: 5]
[1382566548] [info] [logical problem in data on key 6]
[1382566548] [notice] [trying to recalculate data]
[1382566548] [warning] [setting data value of key 7 to default not possible]
[1382566548] [notice] [trying to revert modification]
[1382566548] [error] [runtime data and data in storage differs, can not revert modification]
[1382566548] [critical] [lost connection to storage]
[1382566548] [alert] [can not unlock and schedule processing to id 5]
[1382566548] [debug] [done]
[1382566548] [debug] [processing id 6]
[1382566548] [critical] [lost connection to storage]
[1382566548] [alert] [can not unlock and schedule processing to id 6]
[1382566548] [debug] [done]
```

Since the second run has a logger, that only displays log levels of warning and above, you do not fill up your logs with unnecessary log requests.

But too bad, when something happens *you are loosing information's*.

```shell
----------------------------------------
Second run with normal logger and log level restriction to warning and above.
----------------------------------------
[1382566548] [warning] [setting data value of key 7 to default not possible]
[1382566548] [error] [runtime data and data in storage differs, can not revert modification]
[1382566548] [critical] [lost connection to storage]
[1382566548] [alert] [can not unlock and schedule processing to id 5]
[1382566548] [critical] [lost connection to storage]
[1382566548] [alert] [can not unlock and schedule processing to id 6]
```

The third run is logging everything without any restriction only, if and for the area where something happens.

You are *not loosing information* and *don't fill up your log* with not needed log requests.

```shell
----------------------------------------
Third run with manipulate buffer logger.
----------------------------------------
[1382566548] [debug] [processing id 5]
[1382566548] [info] [collection information and data id: 5]
[1382566548] [info] [logical problem in data on key 6]
[1382566548] [notice] [trying to recalculate data]
[1382566548] [warning] [setting data value of key 7 to default not possible]
[1382566548] [notice] [trying to revert modification]
[1382566548] [error] [runtime data and data in storage differs, can not revert modification]
[1382566548] [critical] [lost connection to storage]
[1382566548] [alert] [can not unlock and schedule processing to id 5]
[1382566548] [debug] [processing id 6]
[1382566548] [critical] [lost connection to storage]
[1382566548] [alert] [can not unlock and schedule processing to id 6]
```

As you can see, only the third run logs all the information you need to debug your code and fix possible bugs.

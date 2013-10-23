# Examples

This component is shipped with a lot of [examples](https://github.com/stevleibelt/php_component_proxy_logger/tree/master/examples/Example), so take a look inside. All examples can be called on the command line like 'php examples/Example/BufferLogger/Example.php'.

To get a rough idea how you are able to regain freedom and silence in your logs, simple execute the [upward flush buffer versus normal logger](https://github.com/stevleibelt/php_component_proxy_logger/blob/master/examples/Example/ManipulateBufferLogger/ExampleWithUpwardFlushBufferTriggerVersusNormalLogger.php) example.
This example shows an example output of a process that deals with some data. First, the normal logger is used. The normal logger outputs each logging request. Secondly, the normal logger is used but only well defined log levels are able to pass. Third time, the upward flush buffer is used as a part of the manipulate buffer logger. This time all information's are logged per data set if a given threshold level is reached. After each data set, the buffer is cleaned.

## Create A Buffer Logger That Flushs The Buffer If Log Level Error Or Above Is Used

Take from [Example01](https://github.com/stevleibelt/php_component_proxy_logger/blob/master/examples/Example/Documentation/Example01.php).

```php
<?php
use Net\Bazzline\Component\ProxyLogger\Factory\LogRequestFactory;
use Net\Bazzline\Component\ProxyLogger\Factory\LogRequestRuntimeBufferFactory;
use Net\Bazzline\Component\ProxyLogger\Factory\ManipulateBufferLoggerFactory;
use Net\Bazzline\Component\ProxyLogger\Factory\UpwardFlushBufferTriggerFactory;
use Net\Bazzline\Component\ProxyLogger\OutputToConsoleLogger;
use Psr\Log\LogLevel;

/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-09-09
 */

//easy up autoloading by using composer autoloader
require_once __DIR__ . '/../../../vendor/autoload.php';

//create a psr3 logger
$innerLogger = new OutputToConsoleLogger();

//create the trigger
$triggerFactory = new UpwardFlushBufferTriggerFactory();
//set trigger to log level \Psr\Log\LogLevel::ERROR
$triggerFactory->setTriggerToLogLevel(LogLevel::ERROR);

//use factory to create manipulate buffer logger
$loggerFactory = new ManipulateBufferLoggerFactory($innerLogger);
$loggerFactory->setLogRequestFactory(new LogRequestFactory());
$loggerFactory->setLogRequestBufferFactory(new LogRequestRuntimeBufferFactory());
$loggerFactory->setFlushBufferTriggerFactory($triggerFactory);
$logger = $loggerFactory->create($innerLogger);

//log request is added to the buffer
$logger->info('this is an info message');
//log request is added to the buffer
$logger->debug('a debug information');
//buffer flush is triggered
$logger->error('the server made a boo boo');
```

## Create A Buffer Logger That Bypass Configured Log Requests From Buffer

Take from [Example02](https://github.com/stevleibelt/php_component_proxy_logger/blob/master/examples/Example/Documentation/Example02.php).

```php
<?php
namespace Example\Documentation;

use Net\Bazzline\Component\ProxyLogger\Factory\BypassBufferFactory;
use Net\Bazzline\Component\ProxyLogger\Factory\LogRequestFactory;
use Net\Bazzline\Component\ProxyLogger\Factory\LogRequestRuntimeBufferFactory;
use Net\Bazzline\Component\ProxyLogger\Factory\ManipulateBufferLoggerFactory;
use Net\Bazzline\Component\ProxyLogger\OutputToConsoleLogger;
use Psr\Log\LogLevel;

/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-09-09
 */

//easy up autoloading by using composer autoloader
require_once __DIR__ . '/../../../vendor/autoload.php';

//create a psr3 logger
$innerLogger = new OutputToConsoleLogger();

//create bypass
$bypassBufferFactory = new BypassBufferFactory();
//set log Level \Psr\Log\LogLevel::INFO to bypass
$bypassBufferFactory->setLogLevelsToBypass(array(LogLevel::INFO));

//use factory to create manipulate buffer logger
$loggerFactory = new ManipulateBufferLoggerFactory();
$loggerFactory->setLogRequestFactory(new LogRequestFactory());
$loggerFactory->setLogRequestBufferFactory(new LogRequestRuntimeBufferFactory());
$loggerFactory->setBypassBufferFactory($bypassBufferFactory);
$logger = $loggerFactory->create($innerLogger);

//log request is added to the buffer
$logger->info('this is an info message');
//log request is passed to all added real loggers
$logger->debug('a debug information');
//log request is added to the buffer
$logger->error('the server made a boo boo');
```

## Use Buffer Logger Inside A Process That Iterates Over A Collection Of Items

Take from [Example03](https://github.com/stevleibelt/php_component_proxy_logger/blob/master/examples/Example/Documentation/Example03.php).

```php
<?php
namespace Example\Documentation;

use Net\Bazzline\Component\ProxyLogger\Factory\LogRequestFactory;
use Net\Bazzline\Component\ProxyLogger\Factory\LogRequestRuntimeBufferFactory;
use Net\Bazzline\Component\ProxyLogger\Factory\BufferLoggerFactory;
use Net\Bazzline\Component\ProxyLogger\LoggerAwareInterface;
use Net\Bazzline\Component\ProxyLogger\OutputToConsoleLogger;
use Psr\Log\LoggerInterface;
use RuntimeException;

/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-09-09
 */

//easy up autoloading by using composer autoloader
require_once __DIR__ . '/../../../vendor/autoload.php';

//create a psr3 logger
$realLogger = new OutputToConsoleLogger();
$bufferLoggerFactory = new BufferLoggerFactory();
$bufferLoggerFactory->setLogRequestFactory(new LogRequestFactory());
$bufferLoggerFactory->setLogRequestBufferFactory(new LogRequestRuntimeBufferFactory());

$bufferLogger = $bufferLoggerFactory->create($realLogger);

//it is assumed that a collection object or a plain array with items is returned
$collectionOfItemsToProcess = getCollectionOfItemsToProcess();

//it is assumed that a class is returned,
// that can handle a item from the collection of items
//it is assumed that a class is returned,
// that implements the LoggerAwareInterface
//it is assumed that a class throws an RuntimeException
// if a item could not be processed
$itemProcessor = new ItemProcessor();
$itemProcessor->setLogger($bufferLogger);

//this example shows the benefit of reclaimed silence and freedom on your log
// only if something happens, log requests are send to your logger
//since i am using the random function to throw an exception, it is possible that
// no exception is thrown. If this happens, please try again
foreach ($collectionOfItemsToProcess as $itemToProcess) {
    try {
        $itemProcessor->setItem($itemToProcess);
        $itemProcessor->execute();
        //clean log buffer if nothing happens
        $itemProcessor->getLogger()->clean();
    } catch (RuntimeException $exception) {
        //add exception message as log request to the buffer
        $itemProcessor->getLogger()->error($exception->getMessage());
        //flush buffer to the real logger to debug what has happen
        $itemProcessor->getLogger()->flush();
    }
}
```

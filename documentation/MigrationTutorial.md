# Migration Tutorial

For the sake of simplicity, i assume you have a LoggerFactory you are calling whenever you need a new Logger.

```php
<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-09-09
 */

/**
 * Factory for creating loggers
 */
class MyLoggerFactory
{
    /**
    * @return \Psr\Log\LoggerInterface
    */
    public function createMyProcessLogger()
    {
        return new Logger();
    }
}
```
All you have to do is to adapt your create method the following way (as an example).

```php
<?php
/**
* @author stev leibelt <artodeto@arcor.de>
* @since 2013-09-09
*/

use \Net\Bazzline\Component\ProxyLogger\Factory\ProxyLoggerFactory();

/**
 * Factory for creating loggers
 */
class MyLoggerFactory
{
    /**
     * @return \Psr\Log\LoggerInterface
     */
    public function createMyProcessLogger()
    {
        $realLogger = new Logger();

        //of course this should not be done on each create call
        $proxyLoggerFactory = new ProxyLoggerFactory();
        $proxyLogger = $proxyLoggerFactory->create($realLogger);

        return $proxyLogger;
    }
}
```

Thats it! Since all proxy loggers are implementing the *\Psr\Log\LoggerInterface*, the whole proxy is fully transparent and all your code will work as before.

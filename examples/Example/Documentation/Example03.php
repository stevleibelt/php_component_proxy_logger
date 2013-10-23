<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-10-23 
 */

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

//----------------
// this is code that makes upper example working
//----------------
function getCollectionOfItemsToProcess()
{
    $collection = array();
    $numberOfItems = rand(5, 15);

    for ($iterator = 0; $iterator < $numberOfItems; $iterator++) {
        $collection[] = 'id-' . $iterator;
    }

    return $collection;
}

/**
 * Class ItemProcessor
 *
 * @package Example\Documentation
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-10-23
 */
class ItemProcessor
{
    /**
     * @var string|mixed
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-10-24
     */
    private $item;

    /**
     * @var \Net\Bazzline\Component\ProxyLogger\Proxy\BufferLoggerInterface
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-10-23
     */
    private $logger;

    /**
     * @param \Net\Bazzline\Component\ProxyLogger\Proxy\BufferLoggerInterface $logger
     * @return $this
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-10-23
     */
    public function setLogger(\Net\Bazzline\Component\ProxyLogger\Proxy\BufferLoggerInterface $logger)
    {
        $this->logger = $logger;

        return $this;
    }

    /**
     * @return null|\Net\Bazzline\Component\ProxyLogger\Proxy\BufferLoggerInterface
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-10-23
     */
    public function getLogger()
    {
        return $this->logger;
    }

    /**
     * @param string|mixed $item
     * @return $this
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-10-24
     */
    public function setItem($item)
    {
        $this->item = $item;

        return $this;
    }

    /**
     * @throws RuntimeException
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-10-24
     */
    public function execute()
    {
        $this->logger->info('processing item ' . $this->item);
        $this->item = null;

        if (rand(0,9) > 7) {
            throw new RuntimeException(
                'Random runtime exception thrown'
            );
        }
    }
}

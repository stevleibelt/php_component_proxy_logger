<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-08-26 
 */

namespace Net\Bazzline\Component\Logger;

use Psr\Log\LoggerInterface;

/**
 * Class ProxyLoggerFactory
 *
 * @package Net\Bazzline\Component\Logger
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-08-26
 */
class ProxyLoggerFactory implements ProxyLoggerFactoryInterface
{
    /**
     * @param LoggerInterface $logger
     * @param mixed $triggeredLogLevel
     * @param array $triggeredLogLevelInheritanceMap
     * @return ProxyLogger
     * @throws InvalidArgumentException
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-26
     */
    public function create(LoggerInterface $logger, $triggeredLogLevel, array $triggeredLogLevelInheritanceMap = array())
    {
        $validator = new isValidLogLevel();

        if (!$validator->setLogLevel($triggeredLogLevel)->isMet())
        {
            throw new InvalidArgumentException(
                'triggered log level is not valid'
            );
        }

        $proxy = new ProxyLogger();
        $proxy->setLogger($logger);

        return $proxy;
    }
}
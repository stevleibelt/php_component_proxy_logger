<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-08-26 
 */

namespace Net\Bazzline\Component\Logger;

use Psr\Log\LoggerInterface;

/**
 * Class ProxyLoggerFactoryInterface
 *
 * @package Net\Bazzline\Component\Logger
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-08-26
 */
interface TriggeredProxyLoggerFactoryInterface
{
    /**
     * @param LoggerInterface $logger
     * @param mixed $triggeredLogLevel
     * @param array $triggeredLogLevelInheritanceMap
     * @return TriggeredBufferLogger
     * @throws InvalidArgumentException
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-26
     */
    public function create(LoggerInterface $logger, $triggeredLogLevel, array $triggeredLogLevelInheritanceMap = array());
}
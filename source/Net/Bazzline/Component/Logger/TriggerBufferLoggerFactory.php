<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-08-26 
 */

namespace Net\Bazzline\Component\Logger;

use Psr\Log\LoggerInterface;

/**
 * Class TriggerBufferLoggerFactory
 *
 * @package Net\Bazzline\Component\Logger
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-08-26
 */
class TriggerBufferLoggerFactory implements TriggerBufferLoggerFactoryInterface
{
    /**
     * @param LoggerInterface $logger
     * @param mixed $logLevelTrigger
     * @param array $logLevelTriggerInheritanceMap
     * @return TriggerBufferLogger
     * @throws InvalidArgumentException
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-26
     */
    public function create(LoggerInterface $logger, $logLevelTrigger, array $logLevelTriggerInheritanceMap = array())
    {
        $validator = new isValidLogLevel();

        if (!$validator->setLogLevel($logLevelTrigger)->isMet()) {
            throw new InvalidArgumentException(
                'triggered log level is not valid'
            );
        }

        if (empty($logLevelTriggerInheritanceMap)) {
            $logLevelTriggerInheritanceMap = require 'logLevelTriggerInheritanceDefaultMap.php';
        }

        $proxy = new TriggerBufferLogger();

        $proxy->addLogger($logger);
        $proxy->setLogLevelTrigger($logLevelTrigger);
        $proxy->setLogLevelTriggerInheritanceMap($logLevelTriggerInheritanceMap);

        return $proxy;
    }
}
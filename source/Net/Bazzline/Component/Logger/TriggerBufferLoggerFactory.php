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
     * @param mixed $triggeredLogLevel
     * @param array $triggeredLogLevelInheritanceMap
     * @return TriggerBufferLogger
     * @throws InvalidArgumentException
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-26
     */
    public function create(LoggerInterface $logger, $triggeredLogLevel, array $triggeredLogLevelInheritanceMap = array())
    {
        $validator = new isValidLogLevel();

        if (!$validator->setLogLevel($triggeredLogLevel)->isMet()) {
            throw new InvalidArgumentException(
                'triggered log level is not valid'
            );
        }

        if (empty($triggeredLogLevelInheritanceMap)) {
            $triggeredLogLevelInheritanceMap = require 'triggerLogLevelInheritanceDefaultMap.php';
        }

        $proxy = new TriggerBufferLogger();

        $proxy->setLogger($logger);
        $proxy->setTriggerToLogLevel($triggeredLogLevel);
        $proxy->setTriggeredLogLevelInheritanceMap($triggeredLogLevelInheritanceMap);

        return $proxy;
    }
}
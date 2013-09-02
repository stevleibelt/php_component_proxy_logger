<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-08-26 
 */

namespace Net\Bazzline\Component\Logger\Proxy;

use Net\Bazzline\Component\Logger\Configuration\DefaultLogLevelThreshold;
use Net\Bazzline\Component\Logger\Configuration\LogLevelThresholdInterface;
use Psr\Log\LoggerInterface;
use Net\Bazzline\Component\Logger\Exception\InvalidArgumentException;
use Net\Bazzline\Component\Logger\Validator\IsValidLogLevel;

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
     * @param LogLevelThresholdInterface $logLevelThreshold
     * @return TriggerBufferLogger
     * @throws InvalidArgumentException
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-26
     */
    public function create(LoggerInterface $logger, $logLevelTrigger, LogLevelThresholdInterface $logLevelThreshold = null)
    {
        $validator = new IsValidLogLevel();

        if (!$validator->setLogLevel($logLevelTrigger)->isMet()) {
            throw new InvalidArgumentException(
                'triggered log level is not valid'
            );
        }

        if (is_null($logLevelThreshold)) {
            $logLevelThreshold = new DefaultLogLevelThreshold();
        }

        $proxy = new TriggerBufferLogger();

        $proxy->addLogger($logger);
        $proxy->setLogLevelTrigger($logLevelTrigger);
        $proxy->setLogLevelThreshold($logLevelThreshold);

        return $proxy;
    }
}

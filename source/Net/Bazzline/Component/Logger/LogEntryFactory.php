<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-08-26 
 */

namespace Net\Bazzline\Component\Logger;

/**
 * Class LogEntryFactory
 *
 * @package Net\Bazzline\Component\Logger
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-08-26
 */
class LogEntryFactory
{
    /**
     * @param $level
     * @param $message
     * @param array $context
     * @return LogEntry
     * @throws InvalidArgumentException
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-26
     */
    public function create($level, $message, array $context = array())
    {
        $validator = new isValidLogLevel();

        if (!$validator->setLogLevel($level)->isMet())
        {
            throw new InvalidArgumentException(
                'level is not valid'
            );
        }

        return new LogEntry($level, $message, $context);
    }
}
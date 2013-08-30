<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-08-26 
 */

namespace Net\Bazzline\Component\Logger\LogEntry;

use Net\Bazzline\Component\Logger\Exception\InvalidArgumentException;
use Net\Bazzline\Component\Logger\Exception\RuntimeException;
use Net\Bazzline\Component\Logger\Validator\IsValidLogLevel;

/**
 * Class LogEntryFactory
 *
 * @package Net\Bazzline\Component\Logger
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-08-26
 */
class LogEntryFactory implements LogEntryFactoryInterface
{
    /**
     * @var string
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-29
     */
    protected $logEntryClassName;

    /**
     * @param string $className
     * @return $this
     * @throws InvalidArgumentException
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-29
     */
    public function setLogEntryClassName($className)
    {
        if (!class_exists($className)) {
            $message = 'classname "' . $className . '" does not exist';
            $className = __NAMESPACE__ . '\\' . $className;
            if (!class_exists($className)) {
                throw new InvalidArgumentException(
                    $message
                );
            }
        }
        $this->logEntryClassName = $className;
    }

    /**
     * @param string $level
     * @param string $message
     * @param array $context
     * @return LogEntry
     * @throws InvalidArgumentException|RuntimeException
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-26
     */
    public function create($level, $message, array $context = array())
    {
        $validator = new isValidLogLevel();

        if (!$validator->setLogLevel($level)->isMet()) {
            throw new InvalidArgumentException(
                'level is not valid'
            );
        }
        if (is_null($this->logEntryClassName)) {
            throw new RuntimeException(
                'no log entry class name set'
            );
        }

        return new $this->logEntryClassName($level, $message, $context);
    }
}
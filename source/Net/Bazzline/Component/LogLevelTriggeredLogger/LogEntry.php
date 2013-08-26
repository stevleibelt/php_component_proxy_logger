<?php
/**
 * @author stev leibelt <artodeot@arcor.de>
 * @since 2013-08-26
 */

namespace Net\Bazzline\Component\LogLevelTriggered;


class LogEntry implements LogEntryInterface
{
    /**
     * @var mixed
     * @author stev leibelt <artodeot@arcor.de>
     * @since 2013-08-26
     */
    protected $logLevel;

    /**
     * @var string
     * @author stev leibelt <artodeot@arcor.de>
     * @since 2013-08-26
     */
    protected $message;

    /**
     * @var array
     * @author stev leibelt <artodeot@arcor.de>
     * @since 2013-08-26
     */
    protected $context;

    /**
     * @param mixed $logLevel
     * @param string $message
     * @param array $context
     * @author stev leibelt <artodeot@arcor.de>
     * @since 2013-08-26
     * @todo implement logLevel evaluation
     */
    public function __construct($logLevel, $message, array $context = array())
    {
        $this->logLevel = $logLevel;
        $this->message = (string) $message;
        $this->context = (array) $context;
    }

    /**
     * @return mixed
     * @author stev leibelt <artodeot@arcor.de>
     * @since 2013-08-26
     */
    public function getLevel()
    {
        return $this->logLevel;
    }

    /**
     * @return string
     * @author stev leibelt <artodeot@arcor.de>
     * @since 2013-08-26
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @return mixed
     * @author stev leibelt <artodeot@arcor.de>
     * @since 2013-08-26
     */
    public function getContext()
    {
        return $this->context;
    }
}
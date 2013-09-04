<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-09-04 
 */

namespace Net\Bazzline\Component\Logger\BufferManipulation;

use Net\Bazzline\Component\Logger\Validator\IsValidLogLevel;
use Psr\Log\InvalidArgumentException;
use Psr\Log\LogLevel;

/**
 * Class AbstractFlushBufferTrigger
 *
 * @package Net\Bazzline\Component\Logger\BufferManipulation
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-09-04
 */
abstract class AbstractFlushBufferTrigger implements FlushBufferTriggerInterface
{
    /**
     * @var null|mixed
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-09-04
     */
    protected $trigger;

    /**
     * @return $this
     * @throws \Psr\Log\InvalidArgumentException
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-26
     */
    public function setTriggerToEmergency()
    {
        return $this->setTrigger(LogLevel::EMERGENCY);
    }

    /**
     * @return $this
     * @throws \Psr\Log\InvalidArgumentException
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-26
     */
    public function setTriggerToAlert()
    {
        return $this->setTrigger(LogLevel::ALERT);
    }

    /**
     * @return $this
     * @throws \Psr\Log\InvalidArgumentException
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-26
     */
    public function setTriggerToCritical()
    {
        return $this->setTrigger(LogLevel::CRITICAL);
    }

    /**
     * @return $this
     * @throws \Psr\Log\InvalidArgumentException
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-26
     */
    public function setTriggerToError()
    {
        return $this->setTrigger(LogLevel::ERROR);
    }

    /**
     * @return $this
     * @throws \Psr\Log\InvalidArgumentException
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-26
     */
    public function setTriggerToWarning()
    {
        return $this->setTrigger(LogLevel::WARNING);
    }

    /**
     * @return $this
     * @throws \Psr\Log\InvalidArgumentException
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-26
     */
    public function setTriggerToNotice()
    {
        return $this->setTrigger(LogLevel::NOTICE);
    }

    /**
     * @return $this
     * @throws \Psr\Log\InvalidArgumentException
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-26
     */
    public function setTriggerToInfo()
    {
        return $this->setTrigger(LogLevel::INFO);
    }

    /**
     * @return $this
     * @throws \Psr\Log\InvalidArgumentException
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-26
     */
    public function setTriggerToDebug()
    {
        return $this->setTrigger(LogLevel::DEBUG);
    }

    /**
     * @param mixed $logLevel
     * @return $this
     * @throws \Psr\Log\InvalidArgumentException
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-26
     */
    protected function setTrigger($logLevel)
    {
        $validator = new IsValidLogLevel();
        $validator->setLogLevel($logLevel);
        if (!$validator->isMet()) {
            throw new InvalidArgumentException(
                'no valid log level provided'
            );
        }
        $this->trigger = $logLevel;
    }

    /**
     * @return bool
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-09-04
     */
    protected function hasTrigger()
    {
        return (!is_null($this->trigger));
    }
}
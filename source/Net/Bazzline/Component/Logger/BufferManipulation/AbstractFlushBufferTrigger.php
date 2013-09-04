<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-09-04 
 */

namespace Net\Bazzline\Component\Logger\BufferManipulation;

use Net\Bazzline\Component\Logger\Validator\IsValidLogLevel;
use Net\Bazzline\Component\Logger\Validator\IsValidLogLevelAwareInterface;
use Psr\Log\InvalidArgumentException;
use Psr\Log\LogLevel;

/**
 * Class AbstractFlushBufferTrigger
 *
 * @package Net\Bazzline\Component\Logger\BufferManipulation
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-09-04
 */
abstract class AbstractFlushBufferTrigger implements FlushBufferTriggerInterface, IsValidLogLevelAwareInterface
{
    /**
     * @var IsValidLogLevel
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-09-04
     */
    protected $isValidLogLevel;

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
        return $this->setTriggerTo(LogLevel::EMERGENCY);
    }

    /**
     * @return $this
     * @throws \Psr\Log\InvalidArgumentException
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-26
     */
    public function setTriggerToAlert()
    {
        return $this->setTriggerTo(LogLevel::ALERT);
    }

    /**
     * @return $this
     * @throws \Psr\Log\InvalidArgumentException
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-26
     */
    public function setTriggerToCritical()
    {
        return $this->setTriggerTo(LogLevel::CRITICAL);
    }

    /**
     * @return $this
     * @throws \Psr\Log\InvalidArgumentException
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-26
     */
    public function setTriggerToError()
    {
        return $this->setTriggerTo(LogLevel::ERROR);
    }

    /**
     * @return $this
     * @throws \Psr\Log\InvalidArgumentException
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-26
     */
    public function setTriggerToWarning()
    {
        return $this->setTriggerTo(LogLevel::WARNING);
    }

    /**
     * @return $this
     * @throws \Psr\Log\InvalidArgumentException
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-26
     */
    public function setTriggerToNotice()
    {
        return $this->setTriggerTo(LogLevel::NOTICE);
    }

    /**
     * @return $this
     * @throws \Psr\Log\InvalidArgumentException
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-26
     */
    public function setTriggerToInfo()
    {
        return $this->setTriggerTo(LogLevel::INFO);
    }

    /**
     * @return $this
     * @throws \Psr\Log\InvalidArgumentException
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-26
     */
    public function setTriggerToDebug()
    {
        return $this->setTriggerTo(LogLevel::DEBUG);
    }

    /**
     * @return null|IsValidLogLevel
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-09-04
     */
    public function getIsValidLogLevel()
    {
        return $this->isValidLogLevel;
    }

    /**
     * @return bool
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-09-04
     */
    public function hasIsValidLogLevel()
    {
        return (!is_null($this->isValidLogLevel));
    }

    /**
     * @param IsValidLogLevel $isValidLogLevel
     * @return $this
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-09-04
     */
    public function setIsValidLogLevel(IsValidLogLevel $isValidLogLevel)
    {
        $this->isValidLogLevel = $isValidLogLevel;

        return $this;
    }

    /**
     * @param mixed $logLevel
     * @return $this
     * @throws \Psr\Log\InvalidArgumentException
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-26
     */
    public function setTriggerTo($logLevel)
    {
        if ($this->hasIsValidLogLevel()) {
            $this->isValidLogLevel->setLogLevel($logLevel);
            if (!$this->isValidLogLevel->isMet()) {
                throw new InvalidArgumentException(
                    'no valid log level provided'
                );
            }
        }
        $this->trigger = $logLevel;
    }

    /**
     * @return null|mixed
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-09-05
     */
    public function getTrigger()
    {
        return $this->trigger;
    }

    /**
     * @return bool
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-09-04
     */
    public function hasTrigger()
    {
        return (!is_null($this->trigger));
    }
}
<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-10-15
 */

namespace Net\Bazzline\Component\ProxyLogger\Factory;

use Net\Bazzline\Component\ProxyLogger\BufferManipulator\FlushBufferTrigger;
use Net\Bazzline\Component\ProxyLogger\Validator\IsValidLogLevel;

/**
 * Class FlushBufferTriggerFactory
 *
 * @package Net\Bazzline\Component\ProxyLogger\Factory
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-10-15
 */
class FlushBufferTriggerFactory implements FlushBufferTriggerFactoryInterface
{
    /**
     * @var \Net\Bazzline\Component\ProxyLogger\Validator\IsValidLogLevel
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-10-18
     */
    private $isValidLogLevel;

    /**
     * @var string
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-10-18
     */
    private $triggerToLogLevel;

    /**
     * @return \Net\Bazzline\Component\ProxyLogger\BufferManipulator\FlushBufferTriggerInterface
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-10-13
     */
    public function create()
    {
        $flushBufferTrigger = new FlushBufferTrigger();

        if (!is_null($this->triggerToLogLevel)) {
            $flushBufferTrigger->setTriggerTo($this->triggerToLogLevel);
        }

        if ($this->hasIsValidLogLevel()) {
            $flushBufferTrigger->setIsValidLogLevel($this->getIsValidLogLevel());
        }

        return $flushBufferTrigger;
    }

    /**
     * @param string $logLevel
     * @return $this
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-10-15
     */
    public function setTriggerToLogLevel($logLevel)
    {
        $this->triggerToLogLevel = $logLevel;

        return $this;
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
}
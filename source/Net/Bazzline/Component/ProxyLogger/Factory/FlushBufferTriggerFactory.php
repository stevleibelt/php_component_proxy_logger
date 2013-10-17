<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-10-15
 */

namespace Net\Bazzline\Component\ProxyLogger\Factory;

use Net\Bazzline\Component\ProxyLogger\BufferManipulator\FlushBufferTrigger;

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
}
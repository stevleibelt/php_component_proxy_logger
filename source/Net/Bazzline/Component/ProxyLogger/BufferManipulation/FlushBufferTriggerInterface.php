<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-08-29 
 */

namespace Net\Bazzline\Component\ProxyLogger\BufferManipulation;

use Net\Bazzline\Component\ProxyLogger\Exception\InvalidArgumentException;

/**
 * Class FlushBufferTriggerInterface
 *
 * @package Net\Bazzline\Component\ProxyLogger
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-08-29
 */
interface FlushBufferTriggerInterface
{
    /**
     * @return $this
     * @throws \Psr\Log\InvalidArgumentException
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-26
     */
    public function setTriggerToEmergency();

    /**
     * @return $this
     * @throws \Psr\Log\InvalidArgumentException
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-26
     */
    public function setTriggerToAlert();

    /**
     * @return $this
     * @throws \Psr\Log\InvalidArgumentException
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-26
     */
    public function setTriggerToCritical();

    /**
     * @return $this
     * @throws \Psr\Log\InvalidArgumentException
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-26
     */
    public function setTriggerToError();

    /**
     * @return $this
     * @throws \Psr\Log\InvalidArgumentException
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-26
     */
    public function setTriggerToWarning();

    /**
     * @return $this
     * @throws \Psr\Log\InvalidArgumentException
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-26
     */
    public function setTriggerToNotice();

    /**
     * @return $this
     * @throws \Psr\Log\InvalidArgumentException
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-26
     */
    public function setTriggerToInfo();

    /**
     * @return $this
     * @throws \Psr\Log\InvalidArgumentException
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-26
     */
    public function setTriggerToDebug();

    /**
     * @param mixed $logLevel
     * @return $this
     * @throws \Psr\Log\InvalidArgumentException
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-09-05
     */
    public function setTriggerTo($logLevel);

    /**
     * @return null|mixed
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-09-05
     */
    public function getTrigger();

    /**
     * @return bool
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-09-05
     */
    public function hasTrigger();

    /**
     * @param string $logLevel
     * @return bool
     * @throws InvalidArgumentException
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-29
     */
    public function triggerBufferFlush($logLevel);
}
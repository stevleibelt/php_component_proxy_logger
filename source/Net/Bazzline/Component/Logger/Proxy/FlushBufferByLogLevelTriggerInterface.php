<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-08-26
 */

namespace Net\Bazzline\Component\Logger\Proxy;

use Net\Bazzline\Component\Logger\Configuration\LogLevelThresholdInterface;
use Net\Bazzline\Component\Logger\Configuration\LogLevelPassThroughInterface;

/**
 * Class FlushBufferByLogLevelTriggerInterface
 *
 * @package Net\Bazzline\Component\Logger
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-08-27
 */
interface FlushBufferByLogLevelTriggerInterface
{
    /**
     * @return $this
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-26
     */
    public function setLogLevelTriggerToEmergency();

    /**
     * @return $this
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-26
     */
    public function setLogLevelTriggerToAlert();

    /**
     * @return $this
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-26
     */
    public function setLogLevelTriggerToCritical();

    /**
     * @return $this
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-26
     */
    public function setLogLevelTriggerToError();

    /**
     * @return $this
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-26
     */
    public function setLogLevelTriggerToWarning();

    /**
     * @return $this
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-26
     */
    public function setLogLevelTriggerToNotice();

    /**
     * @return $this
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-26
     */
    public function setLogLevelTriggerToInfo();

    /**
     * @return $this
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-26
     */
    public function setLogLevelTriggerToDebug();

    /**
     * @param mixed $level
     * @return $this
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-26
     */
    public function setLogLevelTrigger($level);

    /**
     * @param LogLevelThresholdInterface $threshold
     * @return $this
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-26
     */
    public function setLogLevelThreshold(LogLevelThresholdInterface $threshold);

    /**
     * @param LogLevelPassThroughInterface $passThrough
     * @return $this
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-09-02
     */
    public function setLogLevelPassThrough(LogLevelPassThroughInterface $passThrough);

    /**
     * @return null|mixed
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-28
     */
    public function getLogLevelTrigger();
}
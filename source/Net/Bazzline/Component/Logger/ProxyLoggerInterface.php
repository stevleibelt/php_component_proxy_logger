<?php
/**
 * @author stev leibelt <artodeot@arcor.de>
 * @since 2013-08-26
 */

namespace Net\Bazzline\Component\Logger;

use Psr\Log\LoggerAwareInterface;
use Psr\Log\LoggerInterface;

/**
 * Class ProxyLoggerInterface
 *
 * @package Net\Bazzline\Component\LogLevelTriggered\ProxyLogger
 * @author stev leibelt <artodeot@arcor.de>
 * @since 2013-08-26
 */
interface ProxyLoggerInterface extends LoggerInterface, LoggerAwareInterface
{
    /**
     * @return $this
     * @author stev leibelt <artodeot@arcor.de>
     * @since 2013-08-26
     */
    public function setTriggerLevelToEmergency();

    /**
     * @return $this
     * @author stev leibelt <artodeot@arcor.de>
     * @since 2013-08-26
     */
    public function setTriggerLevelToAlert();

    /**
     * @return $this
     * @author stev leibelt <artodeot@arcor.de>
     * @since 2013-08-26
     */
    public function setTriggerLevelToCritical();

    /**
     * @return $this
     * @author stev leibelt <artodeot@arcor.de>
     * @since 2013-08-26
     */
    public function setTriggerLevelToError();

    /**
     * @return $this
     * @author stev leibelt <artodeot@arcor.de>
     * @since 2013-08-26
     */
    public function setTriggerLevelToWarning();

    /**
     * @return $this
     * @author stev leibelt <artodeot@arcor.de>
     * @since 2013-08-26
     */
    public function setTriggerLevelToNotice();

    /**
     * @return $this
     * @author stev leibelt <artodeot@arcor.de>
     * @since 2013-08-26
     */
    public function setTriggerLevelToInfo();

    /**
     * @return $this
     * @author stev leibelt <artodeot@arcor.de>
     * @since 2013-08-26
     */
    public function setTriggerLevelToDebug();
}
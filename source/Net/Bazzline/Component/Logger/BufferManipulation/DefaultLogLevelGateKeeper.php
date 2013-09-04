<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 9/2/13
 */

namespace Net\Bazzline\Component\Logger\BufferManipulation;

use Psr\Log\LogLevel;

/**
 * Class DefaultLogLevelGateKeeper
 *
 * @package Net\Bazzline\Component\Logger\BufferManipulation
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-09-02
 */
class DefaultLogLevelGateKeeper extends AlwaysFlushBufferTrigger
{
    /**
     * @param array $logLevelsToPass
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-09-02
     */
    public function __construct(array $logLevelsToPass = array())
    {
        $logLevelsToPass = array(
            LogLevel::DEBUG => array(
                LogLevel::INFO,
                LogLevel::NOTICE,
                LogLevel::WARNING,
                LogLevel::ERROR,
                LogLevel::CRITICAL,
                LogLevel::ALERT,
                LogLevel::EMERGENCY
            ),
            LogLevel::INFO => array(
                LogLevel::NOTICE,
                LogLevel::WARNING,
                LogLevel::ERROR,
                LogLevel::CRITICAL,
                LogLevel::ALERT,
                LogLevel::EMERGENCY
            ),
            LogLevel::NOTICE => array(
                LogLevel::WARNING,
                LogLevel::ERROR,
                LogLevel::CRITICAL,
                LogLevel::ALERT,
                LogLevel::EMERGENCY
            ),
            LogLevel::WARNING => array(
                LogLevel::ERROR,
                LogLevel::CRITICAL,
                LogLevel::ALERT,
                LogLevel::EMERGENCY
            ),
            LogLevel::ERROR => array(
                LogLevel::CRITICAL,
                LogLevel::ALERT,
                LogLevel::EMERGENCY
            ),
            LogLevel::CRITICAL => array(
                LogLevel::ALERT,
                LogLevel::EMERGENCY
            ),
            LogLevel::ALERT => array(
                LogLevel::EMERGENCY
            )
        );
    }

    /**
     * @return $this
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-26
     */
    public function setTriggerToEmergency()
    {
        // TODO: Implement setTriggerToEmergency() method.
    }

    /**
     * @return $this
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-26
     */
    public function setTriggerToAlert()
    {
        // TODO: Implement setTriggerToAlert() method.
    }

    /**
     * @return $this
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-26
     */
    public function setTriggerToCritical()
    {
        // TODO: Implement setTriggerToCritical() method.
    }

    /**
     * @return $this
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-26
     */
    public function setTriggerToError()
    {
        // TODO: Implement setTriggerToError() method.
    }

    /**
     * @return $this
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-26
     */
    public function setTriggerToWarning()
    {
        // TODO: Implement setTriggerToWarning() method.
    }

    /**
     * @return $this
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-26
     */
    public function setTriggerToNotice()
    {
        // TODO: Implement setTriggerToNotice() method.
    }

    /**
     * @return $this
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-26
     */
    public function setTriggerToInfo()
    {
        // TODO: Implement setTriggerToInfo() method.
    }

    /**
     * @return $this
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-26
     */
    public function setTriggerToDebug()
    {
        // TODO: Implement setTriggerToDebug() method.
    }

    /**
     * @param mixed $level
     * @return $this
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-26
     */
    protected function setTrigger($level)
    {
        // TODO: Implement setTrigger() method.
    }
}
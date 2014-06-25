<?php
/**
 * @author stev leibelt <artodeto@bazzline.net>
 * @since 2013-09-02 
 */

namespace Net\Bazzline\Component\ProxyLogger\BufferManipulator;

/**
 * Class BypassBufferInterface
 *
 * @package Net\Bazzline\Component\ProxyLogger
 * @author stev leibelt <artodeto@bazzline.net>
 * @since 2013-09-02
 */
interface BypassBufferInterface extends BufferManipulatorInterface
{
    /**
     * @return $this
     * @author stev leibelt <artodeto@bazzline.net>
     * @since 2013-09-07
     */
    public function addBypassForLogLevelEmergency();

    /**
     * @return $this
     * @author stev leibelt <artodeto@bazzline.net>
     * @since 2013-09-07
     */
    public function addBypassForLogLevelAlert();

    /**
     * @return $this
     * @author stev leibelt <artodeto@bazzline.net>
     * @since 2013-09-07
     */
    public function addBypassForLogLevelCritical();

    /**
     * @return $this
     * @author stev leibelt <artodeto@bazzline.net>
     * @since 2013-09-07
     */
    public function addBypassForLogLevelError();

    /**
     * @return $this
     * @author stev leibelt <artodeto@bazzline.net>
     * @since 2013-09-07
     */
    public function addBypassForLogLevelWarning();

    /**
     * @return $this
     * @author stev leibelt <artodeto@bazzline.net>
     * @since 2013-09-07
     */
    public function addBypassForLevelNotice();

    /**
     * @return $this
     * @author stev leibelt <artodeto@bazzline.net>
     * @since 2013-09-07
     */
    public function addBypassForLogLevelInfo();

    /**
     * @return $this
     * @author stev leibelt <artodeto@bazzline.net>
     * @since 2013-09-07
     */
    public function addBypassForLogLevelDebug();

    /**
     * @param $logLevel
     * @return $this
     * @author stev leibelt <artodeto@bazzline.net>
     * @since 2013-09-03
     */
    public function addBypassForLogLevel($logLevel);

    /**
     * @param $logLevel
     * @return mixed
     * @author stev leibelt <artodeto@bazzline.net>
     * @since 2013-09-01
     */
    public function bypassBuffer($logLevel);
}
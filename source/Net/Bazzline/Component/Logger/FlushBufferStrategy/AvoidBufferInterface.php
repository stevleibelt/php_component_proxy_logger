<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-09-02 
 */

namespace Net\Bazzline\Component\Logger\FlushBufferStrategy;

/**
 * Class LogLevelPassInterface
 *
 * @package Net\Bazzline\Component\Logger
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-09-02
 */
interface AvoidBufferInterface
{
    /**
     * @param $logLevel
     * @return $this
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-09-03
     */
    public function addAvoidableLogLevel($logLevel);

    /**
     * @param $logLevel
     * @return mixed
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-09-01
     */
    public function avoidBuffering($logLevel);
}
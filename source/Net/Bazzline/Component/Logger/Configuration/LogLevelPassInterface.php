<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-09-02 
 */

namespace Net\Bazzline\Component\Logger\Configuration;

/**
 * Class LogLevelPassInterface
 *
 * @package Net\Bazzline\Component\Logger
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-09-02
 */
interface LogLevelPassInterface
{
    /**
     * @param array $logLevelsToPass
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-09-01
     */
    public function __construct(array $logLevelsToPass);

    /**
     * @param $logLevel
     * @return mixed
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-09-01
     */
    public function letLogLevelPass($logLevel);
}
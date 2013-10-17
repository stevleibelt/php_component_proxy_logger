<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-10-13
 */

namespace Net\Bazzline\Component\ProxyLogger\Factory;

use Net\Bazzline\Component\ProxyLogger\Validator\IsValidLogLevelAwareInterface;

/**
 * Class FlushBufferTriggerFactoryInterface
 *
 * @package Net\Bazzline\Component\ProxyLogger\Factory
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-10-13
 */
interface FlushBufferTriggerFactoryInterface extends IsValidLogLevelAwareInterface
{
    /**
     * @return \Net\Bazzline\Component\ProxyLogger\BufferManipulator\FlushBufferTriggerInterface
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-10-13
     */
    public function create();

    /**
     * @param string $logLevel
     * @return $this
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-10-15
     */
    public function setTriggerToLogLevel($logLevel);
}
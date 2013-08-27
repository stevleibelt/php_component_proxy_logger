<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-08-26 
 */

namespace Net\Bazzline\Component\Logger;

/**
 * Class ProxyLoggerFactoryInjectInterface
 *
 * @package Net\Bazzline\Component\Logger
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-08-26
 */
interface TriggeredBufferLoggerFactoryInjectInterface
{
    /**
     * @param TriggeredBufferLoggerFactoryInterface $factory
     * @return $this
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-26
     */
    public function injectTriggeredBufferLoggerFactory(TriggeredBufferLoggerFactoryInterface $factory);
}
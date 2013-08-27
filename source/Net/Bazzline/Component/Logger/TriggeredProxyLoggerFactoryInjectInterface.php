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
interface TriggeredProxyLoggerFactoryInjectInterface
{
    /**
     * @param TriggeredProxyLoggerFactoryInterface $factory
     * @return $this
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-26
     */
    public function injectTriggeredProxyLoggerFactory(TriggeredProxyLoggerFactoryInterface $factory);
}
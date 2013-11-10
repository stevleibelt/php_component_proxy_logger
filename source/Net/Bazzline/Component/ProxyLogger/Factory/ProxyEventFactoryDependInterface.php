<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-11-10
 */

namespace Net\Bazzline\Component\ProxyLogger\Factory;

/**
 * Interface ProxyEventFactoryDependInterface
 *
 * @package Net\Bazzline\Component\ProxyLogger\Factory
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-11-10
 */
interface ProxyEventFactoryDependInterface
{
    /**
     * @param ProxyEventFactoryInterface $factory
     * @return $this
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-11-10
     */
    public function setProxyEventFactory(ProxyEventFactoryInterface $factory);
} 
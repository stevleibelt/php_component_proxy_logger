<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-10-21
 */

namespace Net\Bazzline\Component\ProxyLogger\Factory;

/**
 * Class FlushBufferTriggerFactoryAwareInterface
 *
 * @package Net\Bazzline\Component\ProxyLogger\Factory
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-10-21
 */
interface FlushBufferTriggerFactoryAwareInterface 
{
    /**
     * @return FlushBufferTriggerFactoryInterface
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-10-21
     */
    public function getFlushBufferTriggerFactory();

    /**
     * @return bool
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-10-21
     */
    public function hasFlushBufferTriggerFactory();

    /**
     * @param FlushBufferTriggerFactoryInterface $factory
     * @return $this
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-10-21
     */
    public function setFlushBufferTriggerFactory(FlushBufferTriggerFactoryInterface $factory);
}
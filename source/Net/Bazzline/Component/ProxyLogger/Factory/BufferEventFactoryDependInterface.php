<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-11-10
 */

namespace Net\Bazzline\Component\ProxyLogger\Factory;

/**
 * Interface BufferEventFactoryDependInterface
 *
 * @package Net\Bazzline\Component\ProxyLogger\Factory
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-11-10
 */
interface BufferEventFactoryDependInterface
{
    /**
     * @param BufferEventFactoryInterface $factory
     * @return $this
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-11-10
     */
    public function setBufferEventFactory(BufferEventFactoryInterface $factory);
} 
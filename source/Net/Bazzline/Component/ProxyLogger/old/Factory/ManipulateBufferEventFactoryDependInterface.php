<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-11-11
 */

namespace Net\Bazzline\Component\ProxyLogger\Factory;

/**
 * Interface ManipulateBufferEventFactoryDependInterface
 *
 * @package Net\Bazzline\Component\ProxyLogger\Factory
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-10-11
 */
interface ManipulateBufferEventFactoryDependInterface
{
    /**
     * @param ManipulateBufferEventFactoryInterface $factory
     * @return $this
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-10-11
     */
    public function setManipulateBufferEventFactory(ManipulateBufferEventFactoryInterface $factory);
} 
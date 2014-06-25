<?php
/**
 * @author stev leibelt <artodeto@bazzline.net>
 * @since 2013-10-21
 */

namespace Net\Bazzline\Component\ProxyLogger\Factory;

/**
 * Class BypassBufferFactoryAwareInterface
 *
 * @package Net\Bazzline\Component\ProxyLogger\Factory
 * @author stev leibelt <artodeto@bazzline.net>
 * @since 2013-10-21
 */
interface BypassBufferFactoryAwareInterface 
{
    /**
     * @return BypassBufferFactoryInterface
     * @author stev leibelt <artodeto@bazzline.net>
     * @since 2013-10-21
     */
    public function getBypassBufferFactory();

    /**
     * @return bool
     * @author stev leibelt <artodeto@bazzline.net>
     * @since 2013-10-21
     */
    public function hasBypassBufferFactory();

    /**
     * @param BypassBufferFactoryInterface $factory
     * @return $this
     * @author stev leibelt <artodeto@bazzline.net>
     * @since 2013-10-21
     */
    public function setBypassBufferFactory(BypassBufferFactoryInterface $factory);
}
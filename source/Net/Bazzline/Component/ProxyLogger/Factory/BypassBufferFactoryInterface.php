<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-10-13
 */

namespace Net\Bazzline\Component\ProxyLogger\Factory;

/**
 * Class BypassBufferFactoryInterface
 *
 * @package Net\Bazzline\Component\ProxyLogger\Factory
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-10-13
 */
interface BypassBufferFactoryInterface
{
    /**
     * @return \Net\Bazzline\Component\ProxyLogger\BufferManipulator\BypassBufferInterface
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-10-13
     */
    public function create();
}
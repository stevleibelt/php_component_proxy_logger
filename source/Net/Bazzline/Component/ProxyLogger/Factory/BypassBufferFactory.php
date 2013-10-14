<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-10-14
 */

namespace Net\Bazzline\Component\ProxyLogger\Factory;

use Net\Bazzline\Component\ProxyLogger\BufferManipulator\BypassBuffer;

/**
 * Class BypassBufferFactory
 *
 * @package Net\Bazzline\Component\ProxyLogger\Factory
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-10-14
 */
class BypassBufferFactory implements BypassBufferFactoryInterface
{
    /**
     * @return \Net\Bazzline\Component\ProxyLogger\BufferManipulator\BypassBufferInterface
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-10-13
     */
    public function create()
    {
        $bypassBuffer = new BypassBuffer();

        return $bypassBuffer;
    }
}
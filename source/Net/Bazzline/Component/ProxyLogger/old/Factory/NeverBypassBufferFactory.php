<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-10-19 
 */

namespace Net\Bazzline\Component\ProxyLogger\Factory;

use Net\Bazzline\Component\ProxyLogger\BufferManipulator\NeverBypassBuffer;

/**
 * Class NeverBypassBufferFactory
 *
 * @package Net\Bazzline\Component\ProxyLogger\Factory
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-10-19
 */
class NeverBypassBufferFactory extends AbstractBypassBufferFactory
{
    /**
     * @return \Net\Bazzline\Component\ProxyLogger\BufferManipulator\BypassBufferInterface
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-10-20
     */
    protected function createNewBypassBufferInstance()
    {
        return new NeverBypassBuffer();
    }
}
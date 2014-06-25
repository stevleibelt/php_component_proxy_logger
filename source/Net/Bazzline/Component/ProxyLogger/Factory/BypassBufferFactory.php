<?php
/**
 * @author stev leibelt <artodeto@bazzline.net>
 * @since 2013-10-19 
 */

namespace Net\Bazzline\Component\ProxyLogger\Factory;

use Net\Bazzline\Component\ProxyLogger\BufferManipulator\BypassBuffer;

/**
 * Class BypassBufferFactory
 *
 * @package Net\Bazzline\Component\ProxyLogger\Factory
 * @author stev leibelt <artodeto@bazzline.net>
 * @since 2013-10-19
 */
class BypassBufferFactory extends AbstractBypassBufferFactory
{
    /**
     * @return \Net\Bazzline\Component\ProxyLogger\BufferManipulator\BypassBufferInterface
     * @author stev leibelt <artodeto@bazzline.net>
     * @since 2013-10-20
     */
    protected function createNewBypassBufferInstance()
    {
        return new BypassBuffer();
    }
}
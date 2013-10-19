<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-10-19 
 */

namespace Net\Bazzline\Component\ProxyLogger\Factory;

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
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-10-19
     */
    public function __construct()
    {
        $this->bypassBufferClassName = '\Net\Bazzline\Component\ProxyLogger\BufferManipulator\NeverBypassBuffer';
    }
}
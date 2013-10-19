<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-10-19 
 */

namespace Net\Bazzline\Component\ProxyLogger\Factory;

/**
 * Class BypassBufferFactory
 *
 * @package Net\Bazzline\Component\ProxyLogger\Factory
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-10-19
 */
class BypassBufferFactory extends AbstractBypassBufferFactory
{
    /**
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-10-19
     */
    public function __construct()
    {
        $this->bypassBufferClassName = '\Net\Bazzline\Component\ProxyLogger\BufferManipulator\BypassBuffer';
    }
}
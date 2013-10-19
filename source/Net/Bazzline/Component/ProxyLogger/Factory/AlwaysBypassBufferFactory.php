<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-10-19 
 */

namespace Net\Bazzline\Component\ProxyLogger\Factory;

/**
 * Class AlwaysBypassBufferFactory
 *
 * @package Net\Bazzline\Component\ProxyLogger\Factory
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-10-19
 */
class AlwaysBypassBufferFactory extends AbstractBypassBufferFactory
{
    /**
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-10-19
     */
    public function __construct()
    {
        $this->bypassBufferClassName = '\Net\Bazzline\Component\ProxyLogger\BufferManipulator\AlwaysBypassBuffer';
    }
}
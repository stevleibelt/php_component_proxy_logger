<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-09-05 
 */

namespace Net\Bazzline\Component\ProxyLogger\BufferManipulator;

/**
 * Class NeverBypassBuffer
 *
 * @package Net\Bazzline\Component\ProxyLogger\BufferManipulator
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-09-05
 */
class NeverBypassBuffer extends BypassBuffer
{
    /**
     * @param mixed $logLevel
     * @return bool
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-09-01
     */
    public function bypassBuffer($logLevel)
    {
        return false;
    }
}
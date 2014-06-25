<?php
/**
 * @author stev leibelt <artodeto@bazzline.net>
 * @since 2013-09-05 
 */

namespace Net\Bazzline\Component\ProxyLogger\BufferManipulator;

/**
 * Class AlwaysBypassBuffer
 *
 * @package Net\Bazzline\Component\ProxyLogger\BufferManipulator
 * @author stev leibelt <artodeto@bazzline.net>
 * @since 2013-09-05
 */
class AlwaysBypassBuffer extends BypassBuffer
{
    /**
     * @param mixed $logLevel
     * @return bool
     * @author stev leibelt <artodeto@bazzline.net>
     * @since 2013-09-01
     */
    public function bypassBuffer($logLevel)
    {
        return true;
    }
}
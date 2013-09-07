<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-09-05 
 */

namespace Net\Bazzline\Component\Logger\BufferManipulation;

/**
 * Class AlwaysAvoidBuffer
 *
 * @package Net\Bazzline\Component\Logger\BufferManipulation
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-09-05
 */
class AlwaysAvoidBuffer extends AvoidBuffer
{
    /**
     * @param mixed $logLevel
     * @return bool
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-09-01
     */
    public function bypassBuffer($logLevel)
    {
        return true;
    }
}
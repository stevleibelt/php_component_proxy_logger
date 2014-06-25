<?php
/**
 * @author stev leibelt <artodeto@bazzline.net>
 * @since 8/27/13
 */

namespace Net\Bazzline\Component\ProxyLogger\Factory;

use Net\Bazzline\Component\ProxyLogger\LogRequest\LogRequestRuntimeBuffer;

/**
 * Class LogRequestRuntimeBufferFactory
 *
 * @package Net\Bazzline\Component\ProxyLogger
 * @author stev leibelt <artodeto@bazzline.net>
 * @since 2013-08-27
 */
class LogRequestRuntimeBufferFactory implements LogRequestBufferFactoryInterface
{
    /**
     * @return LogRequestRuntimeBuffer
     * @author stev leibelt <artodeto@bazzline.net>
     * @since 2013-08-27
     */
    public function create()
    {
        return new LogRequestRuntimeBuffer();
    }
}
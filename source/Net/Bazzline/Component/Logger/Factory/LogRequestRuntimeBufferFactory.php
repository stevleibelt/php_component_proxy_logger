<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 8/27/13
 */

namespace Net\Bazzline\Component\Logger\Factory;

use Net\Bazzline\Component\Logger\LogRequest\LogRequestRuntimeBuffer;

/**
 * Class LogRequestRuntimeBufferFactory
 *
 * @package Net\Bazzline\Component\Logger
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-08-27
 */
class LogRequestRuntimeBufferFactory implements LogRequestBufferFactoryInterface
{
    /**
     * @return LogRequestRuntimeBuffer
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-27
     */
    public function create()
    {
        return new LogRequestRuntimeBuffer();
    }
}
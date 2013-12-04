<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 8/27/13
 */

namespace Net\Bazzline\Component\ProxyLogger\Factory;

use Net\Bazzline\Component\ProxyLogger\LogRequest\LogRequestBufferInterface;

/**
 * Class LogRequestRuntimeBufferFactoryInterface
 *
 * @package Net\Bazzline\Component\ProxyLogger\LogRequest
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-08-27
 */
interface LogRequestBufferFactoryInterface
{
    /**
     * @return LogRequestBufferInterface
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-27
     */
    public function create();
}
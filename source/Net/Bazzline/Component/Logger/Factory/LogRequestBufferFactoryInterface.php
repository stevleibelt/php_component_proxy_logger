<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 8/27/13
 */

namespace Net\Bazzline\Component\Logger\Factory;

use Net\Bazzline\Component\Logger\LogRequest\LogRequestBufferInterface;

/**
 * Class LogRequestRuntimeBufferFactoryInterface
 *
 * @package Net\Bazzline\Component\Logger\LogRequest
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
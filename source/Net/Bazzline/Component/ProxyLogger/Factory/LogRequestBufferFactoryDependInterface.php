<?php
/**
 * @author stev leibelt <artodeto@bazzline.net>
 * @since 8/27/13
 */

namespace Net\Bazzline\Component\ProxyLogger\Factory;

/**
 * Class LogRequestBufferFactoryDependInterface
 *
 * @package Net\Bazzline\Component\ProxyLogger
 * @author stev leibelt <artodeto@bazzline.net>
 * @since 2013-08-27
 */
interface LogRequestBufferFactoryDependInterface
{
    /**
     * @param LogRequestBufferFactoryInterface $factory
     * @return mixed
     * @author stev leibelt <artodeto@bazzline.net>
     * @since 2013-08-27
     */
    public function setLogRequestBufferFactory(LogRequestBufferFactoryInterface $factory);
}
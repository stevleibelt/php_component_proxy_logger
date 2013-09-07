<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 8/27/13
 */

namespace Net\Bazzline\Component\Logger\Factory;

/**
 * Class LogRequestBufferFactoryAwareInterface
 *
 * @package Net\Bazzline\Component\Logger
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-08-27
 */
interface LogRequestBufferFactoryAwareInterface
{
    /**
     * @return null|LogRequestBufferFactoryInterface $factory
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-09-05
     */
    public function getLogRequestBufferFactory();

    /**
     * @return bool
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-09-05
     */
    public function hasLogRequestBufferFactory();

    /**
     * @param LogRequestBufferFactoryInterface $factory
     * @return mixed
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-27
     */
    public function setLogRequestBufferFactory(LogRequestBufferFactoryInterface $factory);
}
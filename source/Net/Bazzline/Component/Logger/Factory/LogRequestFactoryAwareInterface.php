<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-08-26 
 */

namespace Net\Bazzline\Component\Logger\Factory;

/**
 * Class LogRequestFactoryAwareInterface
 *
 * @package Net\Bazzline\Component\Logger
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-08-26
 */
interface LogRequestFactoryAwareInterface
{
    /**
     * @return null|LogRequestFactoryInterface $factory
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-09-05
     */
    public function getLogRequestFactory();

    /**
     * @return bool
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-09-05
     */
    public function hasLogRequestFactory();

    /**
     * @param LogRequestFactoryInterface $factory
     * @return $this
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-26
     */
    public function setLogRequestFactory(LogRequestFactoryInterface $factory);
}
<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-09-08 
 */

namespace Net\Bazzline\Component\ProxyLogger\Proxy;

use Psr\Log\LoggerInterface;
use Psr\Log\LoggerAwareInterface as ParentInterface;

/**
 * Class LoggerAwareInterface
 *
 * @package Net\Bazzline\Component\ProxyLogger
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-09-08
 */
interface LoggerAwareInterface extends ParentInterface
{
    /**
     * @return null|LoggerInterface
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-09-08
     */
    public function getLogger();

    /**
     * @return bool
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-09-08
     */
    public function hasLogger();
}
<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-08-26 
 */

namespace Net\Bazzline\Component\ProxyLogger\Factory;

use Net\Bazzline\Component\ProxyLogger\LogRequest\LogRequest;
use Net\Bazzline\Component\ProxyLogger\Exception\InvalidArgumentException;
use Net\Bazzline\Component\ProxyLogger\Exception\RuntimeException;

/**
 * Class LogRequestFactoryInterface
 *
 * @package Net\Bazzline\Component\ProxyLogger
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-08-26
 */
interface LogRequestFactoryInterface
{
    /**
     * @param string $level
     * @param string $message
     * @param array $context
     * @return LogRequest
     * @throws InvalidArgumentException
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-26
     */
    public function create($level, $message, array $context = array());

    /**
     * @param string $className
     * @return $this
     * @throws InvalidArgumentException|RuntimeException
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-29
     */
    public function setLogRequestClassName($className);
}
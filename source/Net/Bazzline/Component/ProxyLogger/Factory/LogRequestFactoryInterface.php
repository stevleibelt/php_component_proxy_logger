<?php
/**
 * @author stev leibelt <artodeto@bazzline.net>
 * @since 2013-08-26 
 */

namespace Net\Bazzline\Component\ProxyLogger\Factory;

use Net\Bazzline\Component\ProxyLogger\LogRequest\LogRequestInterface;
use Net\Bazzline\Component\ProxyLogger\Exception\InvalidArgumentException;
use Net\Bazzline\Component\ProxyLogger\Validator\IsValidLogLevelAwareInterface;

/**
 * Class LogRequestFactoryInterface
 *
 * @package Net\Bazzline\Component\ProxyLogger
 * @author stev leibelt <artodeto@bazzline.net>
 * @since 2013-08-26
 */
interface LogRequestFactoryInterface extends IsValidLogLevelAwareInterface
{
    /**
     * @param string $level
     * @param string $message
     * @param array $context
     * @return LogRequestInterface
     * @throws InvalidArgumentException
     * @author stev leibelt <artodeto@bazzline.net>
     * @since 2013-08-26
     */
    public function create($level, $message, array $context = array());
}
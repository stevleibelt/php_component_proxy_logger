<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-11-10
 */

namespace Net\Bazzline\Component\ProxyLogger\Factory;

use Net\Bazzline\Component\ProxyLogger\LogRequest\LogRequestBufferInterface;
use Net\Bazzline\Component\ProxyLogger\LogRequest\LogRequestInterface;
use Psr\Log\LoggerInterface;

/**
 * Interface EventFactoryInterface
 *
 * @package Net\Bazzline\Component\ProxyLogger\Factory
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-11-10
 */
interface BufferEventFactoryInterface
{
    /**
     * @param null|array|LoggerInterface[] $loggerCollection
     * @param null|LogRequestBufferInterface $logRequestBuffer
     * @param null|LogRequestInterface $logRequest
     * @return \Net\Bazzline\Component\ProxyLogger\Event\ProxyEvent
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-11-10
     */
    public function create(array $loggerCollection = null, LogRequestBufferInterface $logRequestBuffer = null, LogRequestInterface $logRequest = null);
}
<?php
/**
 * @author stev leibelt <artodeto@bazzline.net>
 * @since 2013-11-10
 */

namespace Net\Bazzline\Component\ProxyLogger\Factory;

use Net\Bazzline\Component\ProxyLogger\LogRequest\LogRequestInterface;
use Psr\Log\LoggerInterface;

/**
 * Interface EventFactoryInterface
 *
 * @package Net\Bazzline\Component\ProxyLogger\Factory
 * @author stev leibelt <artodeto@bazzline.net>
 * @since 2013-11-10
 */
interface ProxyEventFactoryInterface
{
    /**
     * @param null|array|LoggerInterface[] $loggerCollection
     * @param null|LogRequestInterface $logRequest
     * @return \Net\Bazzline\Component\ProxyLogger\Event\ProxyEvent
     * @author stev leibelt <artodeto@bazzline.net>
     * @since 2013-11-10
     */
    public function create(array $loggerCollection = null, LogRequestInterface $logRequest = null);
}
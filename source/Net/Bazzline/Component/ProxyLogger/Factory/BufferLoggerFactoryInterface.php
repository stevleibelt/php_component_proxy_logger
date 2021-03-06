<?php
/**
 * @author stev leibelt <artodeto@bazzline.net>
 * @since 2013-09-08 
 */

namespace Net\Bazzline\Component\ProxyLogger\Factory;

use Psr\Log\LoggerInterface;

/**
 * Class BufferLoggerFactoryInterface
 *
 * @package Net\Bazzline\Component\ProxyLogger\Factory
 * @author stev leibelt <artodeto@bazzline.net>
 * @since 2013-09-08
 */
interface BufferLoggerFactoryInterface extends LogRequestFactoryDependInterface, LogRequestBufferFactoryDependInterface
{
    /**
     * @param LoggerInterface $logger
     * @return \Net\Bazzline\Component\ProxyLogger\Logger\BufferLoggerInterface
     * @author stev leibelt <artodeto@bazzline.net>
     * @since 2013-09-08
     */
    public function create(LoggerInterface $logger);
}
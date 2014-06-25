<?php
/**
 * @author stev leibelt <artodeto@bazzline.net>
 * @since 2013-08-26 
 */

namespace Net\Bazzline\Component\ProxyLogger\Factory;

/**
 * Class ManipulateBufferLoggerFactoryInterface
 *
 * @package Net\Bazzline\Component\ProxyLogger\Factory
 * @author stev leibelt <artodeto@bazzline.net>
 * @since 2013-08-26
 */
interface ManipulateBufferLoggerFactoryInterface extends BufferLoggerFactoryInterface, FlushBufferTriggerFactoryAwareInterface, BypassBufferFactoryAwareInterface
{
}
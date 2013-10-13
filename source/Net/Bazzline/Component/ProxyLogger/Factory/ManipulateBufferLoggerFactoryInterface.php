<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-08-26 
 */

namespace Net\Bazzline\Component\ProxyLogger\Factory;

use Net\Bazzline\Component\ProxyLogger\BufferManipulator\BypassBufferAwareInterface;
use Net\Bazzline\Component\ProxyLogger\BufferManipulator\FlushBufferTriggerAwareInterface;

/**
 * Class ManipulateBufferLoggerFactoryInterface
 *
 * @package Net\Bazzline\Component\ProxyLogger\Factory
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-08-26
 * @todo replace injection of BypassBuffer and FlushBufferTrigger with factories
 */
interface ManipulateBufferLoggerFactoryInterface extends BufferLoggerFactoryInterface, FlushBufferTriggerAwareInterface, BypassBufferAwareInterface
{
}
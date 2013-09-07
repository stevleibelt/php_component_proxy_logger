<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-08-27
 */

namespace Net\Bazzline\Component\Logger\Proxy;

use Net\Bazzline\Component\Logger\BufferManipulation\AvoidBufferAwareInterface;
use Net\Bazzline\Component\Logger\BufferManipulation\FlushBufferTriggerAwareInterface;

/**
 * Class ManipulateBufferLoggerInterface
 *
 * @package Net\Bazzline\Component\Logger
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-08-27
 */
interface ManipulateBufferLoggerInterface extends FlushBufferTriggerAwareInterface, AvoidBufferAwareInterface, BufferLoggerInterface
{
}
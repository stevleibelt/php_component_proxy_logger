<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-08-27
 */

namespace Net\Bazzline\Component\Logger\Proxy;

use Net\Bazzline\Component\Logger\FlushBufferByLogLevelTriggerInterface;

/**
 * Class TriggerBufferLoggerInterface
 *
 * @package Net\Bazzline\Component\Logger
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-08-27
 */
interface TriggerBufferLoggerInterface extends FlushBufferByLogLevelTriggerInterface, BufferLoggerInterface
{
}
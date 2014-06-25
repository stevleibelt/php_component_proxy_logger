<?php
/**
 * @author stev leibelt <artodeto@bazzline.net>
 * @since 2013-10-24 
 */

namespace Example\ManipulateBufferLogger\Helper;

use Example\ManipulateBufferLogger\Helper\WakeUpCallLogRequest;
use Net\Bazzline\Component\ProxyLogger\Factory\AbstractLogRequestFactory;
use Net\Bazzline\Component\ProxyLogger\LogRequest\LogRequestInterface;

/**
 * Class WakeUpCallLogRequestFactory
 *
 * @package Example\ManipulateBufferLogger
 * @author stev leibelt <artodeto@bazzline.net>
 * @since 2013-10-24
 */
class WakeUpCallLogRequestFactory extends AbstractLogRequestFactory
{
    /**
     * @param string $level
     * @param string $message
     * @param array $context
     * @return LogRequestInterface
     * @author stev leibelt <artodeto@bazzline.net>
     * @since 2013-10-21
     */
    protected function createNewLogRequestInstance($level, $message, array $context = array())
    {
        return new WakeUpCallLogRequest($level, $message, $context);
    }
}

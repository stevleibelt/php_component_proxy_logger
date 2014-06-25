<?php
/**
 * @author stev leibelt <artodeto@bazzline.net>
 * @since 2013-10-24 
 */

namespace Example\ManipulateBufferLogger\Helper;

use Net\Bazzline\Component\ProxyLogger\LogRequest\LogRequest;

/**
 * Class WakeUpCallLogRequest
 *
 * @package Example\ManipulateBufferLogger
 * @author stev leibelt <artodeto@bazzline.net>
 * @since 2013-10-24
 */
class WakeUpCallLogRequest extends LogRequest
{
    /**
     * @param mixed $logLevel
     * @param string $message
     * @param array $context
     * @author stev leibelt <artodeto@bazzline.net>
     * @since 2013-10-24
     */
    public function __construct($logLevel, $message, array $context = array())
    {
        $message = 'wakeup call] [' . $message;
        parent::__construct($logLevel, $message, $context);
    }
}

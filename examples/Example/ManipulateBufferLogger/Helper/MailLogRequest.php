<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-10-24 
 */

namespace Example\ManipulateBufferLogger\Helper;

use Net\Bazzline\Component\ProxyLogger\LogRequest\LogRequest;

/**
 * Class MailLogRequest
 *
 * @package Example\ManipulateBufferLogger
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-10-24
 */
class MailLogRequest extends LogRequest
{
    /**
     * @param mixed $logLevel
     * @param string $message
     * @param array $context
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-10-24
     */
    public function __construct($logLevel, $message, array $context = array())
    {
        $message = 'mail ] [' . $message;
        parent::__construct($logLevel, $message, $context);
    }
}

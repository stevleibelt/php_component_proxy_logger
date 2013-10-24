<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-10-24 
 */

namespace Example\ManipulateBufferLogger\Helper;

use Example\ManipulateBufferLogger\Helper\MailLogRequest;
use Net\Bazzline\Component\ProxyLogger\Factory\AbstractLogRequestFactory;
use Net\Bazzline\Component\ProxyLogger\LogRequest\LogRequestInterface;

/**
 * Class MailLogRequestFactory
 *
 * @package Example\ManipulateBufferLogger
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-10-24
 */
class MailLogRequestFactory extends AbstractLogRequestFactory
{
    /**
     * @param string $level
     * @param string $message
     * @param array $context
     * @return LogRequestInterface
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-10-21
     */
    protected function createNewLogRequestInstance($level, $message, array $context = array())
    {
        return new MailLogRequest($level, $message, $context);
    }
}
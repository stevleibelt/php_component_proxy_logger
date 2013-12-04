<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-12-05 
 */

namespace Net\Bazzline\Component\ProxyLogger\Event;

use Symfony\Component\EventDispatcher\Event;

/**
 * Class LogRequestEvent
 * @package Net\Bazzline\Component\ProxyLogger\Event
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-12-05
 * @todo add event interface
 */
class LogRequestEvent extends Event
{
    private $loggerCollection;

    private $logRequest;

    private $logRequestBuffer;

    private $logRequestBufferManipulatorCollection;

    private $logRequestValidatorCollection;
}
<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-11-08
 */

namespace Net\Bazzline\Component\ProxyLogger\Event;

/**
 * Class BufferEvent
 *
 * @package Net\Bazzline\Component\ProxyLogger\Event
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-11-08
 */
class BufferEvent extends ProxyEvent
{
    const BUFFER_FLUSH = 'bufferEvent.bufferFlush';
    const BUFFER_CLEAN = 'bufferEvent.bufferClean';
    const ADD_LOG_REQUEST_TO_BUFFER = 'bufferEvent.addLogRequestToBuffer';
}
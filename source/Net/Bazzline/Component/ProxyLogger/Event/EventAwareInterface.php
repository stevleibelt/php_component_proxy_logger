<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-11-11
 */

namespace Net\Bazzline\Component\ProxyLogger\Event;

/**
 * Class EventAwareInterface
 *
 * @package Net\Bazzline\Component\ProxyLogger\Event
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-11-11
 */
interface EventAwareInterface
{
    /**
     * @return EventInterface|ProxyEvent|BufferEvent|ManipulateBufferEvent
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-11-11
     */
    public function getEvent();

    /**
     * @param EventInterface $event
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-11-11
     */
    public function setEvent(EventInterface $event);
} 
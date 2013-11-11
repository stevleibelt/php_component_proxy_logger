<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-11-11
 */

namespace Net\Bazzline\Component\ProxyLogger\Event;

/**
 * Class BufferEventDependInterface
 *
 * @package Net\Bazzline\Component\ProxyLogger\Event
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-11-11
 */
interface BufferEventAwareInterface
{
    /**
     * @return BufferEvent
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-11-11
     */
    public function getBufferEvent();

    /**
     * @param BufferEvent $event
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-11-11
     */
    public function setBufferEvent(BufferEvent $event);
} 
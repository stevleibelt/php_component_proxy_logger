<?php
/**
 * @author stev leibelt <artodeto@bazzline.net>
 * @since 2013-11-09
 */

namespace Net\Bazzline\Component\ProxyLogger\Event;

use Net\Bazzline\Component\ProxyLogger\BufferManipulator\BypassBufferAwareInterface;
use Net\Bazzline\Component\ProxyLogger\BufferManipulator\BypassBufferInterface;
use Net\Bazzline\Component\ProxyLogger\BufferManipulator\FlushBufferTriggerAwareInterface;
use Net\Bazzline\Component\ProxyLogger\BufferManipulator\FlushBufferTriggerInterface;

/**
 * Class ManipulateBufferEvent
 *
 * @package Net\Bazzline\Component\ProxyLogger\Event
 * @author stev leibelt <artodeto@bazzline.net>
 * @since 2013-11-09
 */
class ManipulateBufferEvent extends BufferEvent implements BypassBufferAwareInterface, FlushBufferTriggerAwareInterface
{
    /**
     * @var BypassBufferInterface
     * @author stev leibelt <artodeto@bazzline.net>
     * @since 2013-11-09
     */
    private $bypassBuffer;

    /**
     * @var FlushBufferTriggerInterface
     * @author stev leibelt <artodeto@bazzline.net>
     * @since 2013-11-09
     */
    private $flushBufferTrigger;

    /**
     * @return null|BypassBufferInterface
     * @author stev leibelt <artodeto@bazzline.net>
     * @since 2013-09-03
     */
    public function getBypassBuffer()
    {
        return $this->bypassBuffer;
    }

    /**
     * @return bool
     * @author stev leibelt <artodeto@bazzline.net>
     * @since 2013-09-03
     */
    public function hasBypassBuffer()
    {
        return (!is_null($this->bypassBuffer));
    }

    /**
     * @param BypassBufferInterface $bypassBuffer
     * @return $this
     * @author stev leibelt <artodeto@bazzline.net>
     * @since 2013-09-03
     */
    public function setBypassBuffer(BypassBufferInterface $bypassBuffer)
    {
        $this->bypassBuffer = $bypassBuffer;

        return $this;
    }

    /**
     * @return null|FlushBufferTriggerInterface
     * @author stev leibelt <artodeto@bazzline.net>
     * @since 2013-09-03
     */
    public function getFlushBufferTrigger()
    {
        return $this->flushBufferTrigger;
    }

    /**
     * @return bool
     * @author stev leibelt <artodeto@bazzline.net>
     * @since 2013-09-03
     */
    public function hasFlushBufferTrigger()
    {
        return (!is_null($this->flushBufferTrigger));
    }

    /**
     * @param FlushBufferTriggerInterface $flushBufferTrigger
     * @return $this
     * @author stev leibelt <artodeto@bazzline.net>
     * @since 2013-09-03
     */
    public function setFlushBufferTrigger(FlushBufferTriggerInterface $flushBufferTrigger)
    {
        $this->flushBufferTrigger = $flushBufferTrigger;

        return $this;
    }
}
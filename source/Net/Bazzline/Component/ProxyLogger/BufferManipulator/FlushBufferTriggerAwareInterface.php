<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-09-03 
 */

namespace Net\Bazzline\Component\ProxyLogger\BufferManipulator;

/**
 * Class FlushBufferTriggerAwareInterface
 *
 * @package Net\Bazzline\Component\ProxyLogger\BufferManipulator
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-09-03
 */
interface FlushBufferTriggerAwareInterface
{
    /**
     * @return null|FlushBufferTriggerInterface
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-09-03
     */
    public function getFlushBufferTrigger();

    /**
     * @return bool
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-09-03
     */
    public function hasFlushBufferTrigger();

    /**
     * @param FlushBufferTriggerInterface $flushBufferTrigger
     * @return $this
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-09-03
     */
    public function setFlushBufferTrigger(FlushBufferTriggerInterface $flushBufferTrigger);
}
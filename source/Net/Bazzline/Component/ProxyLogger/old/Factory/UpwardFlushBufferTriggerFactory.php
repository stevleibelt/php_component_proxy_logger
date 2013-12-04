<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-10-20
 */

namespace Net\Bazzline\Component\ProxyLogger\Factory;

use Net\Bazzline\Component\ProxyLogger\BufferManipulator\UpwardFlushBufferTrigger;

/**
 * Class UpwardFlushBufferTriggerFactory
 *
 * @package Net\Bazzline\Component\ProxyLogger\Factory
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-10-20
 */
class UpwardFlushBufferTriggerFactory extends AbstractFlushBufferTriggerFactory
{
    /**
     * @return \Net\Bazzline\Component\ProxyLogger\BufferManipulator\UpwardFlushBufferTrigger|\Net\Bazzline\Component\ProxyLogger\BufferManipulator\FlushBufferTriggerInterface
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-10-20
     */
    protected function createNewFlushBufferInstance()
    {
        return new UpwardFlushBufferTrigger;
    }
}
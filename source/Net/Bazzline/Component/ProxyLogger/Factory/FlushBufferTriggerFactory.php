<?php
/**
 * @author stev leibelt <artodeto@bazzline.net>
 * @since 2013-10-20
 */

namespace Net\Bazzline\Component\ProxyLogger\Factory;

use Net\Bazzline\Component\ProxyLogger\BufferManipulator\FlushBufferTrigger;

/**
 * Class FlushBufferLoggerFactory
 *
 * @package Net\Bazzline\Component\ProxyLogger\Factory
 * @author stev leibelt <artodeto@bazzline.net>
 * @since 2013-10-20
 */
class FlushBufferTriggerFactory extends AbstractFlushBufferTriggerFactory
{
    /**
     * @return \Net\Bazzline\Component\ProxyLogger\BufferManipulator\FlushBufferTriggerInterface
     * @author stev leibelt <artodeto@bazzline.net>
     * @since 2013-10-20
     */
    protected function createNewFlushBufferInstance()
    {
        return new FlushBufferTrigger();
    }
}
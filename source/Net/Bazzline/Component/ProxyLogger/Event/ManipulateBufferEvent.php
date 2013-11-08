<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-11-09
 */

namespace Net\Bazzline\Component\ProxyLogger\Event;

use Net\Bazzline\Component\ProxyLogger\BufferManipulator\BufferManipulatorInterface;

/**
 * Class ManipulateBufferEvent
 *
 * @package Net\Bazzline\Component\ProxyLogger\Event
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-11-09
 */
class ManipulateBufferEvent extends BufferEvent
{
    /**
     * @var BufferManipulatorInterface[]
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-11-09
     */
    private $bufferManipulators = array();

    /**
     * @param BufferManipulatorInterface $bufferManipulator
     * @return $this
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-11-09
     */
    public function addBufferManipulator(BufferManipulatorInterface $bufferManipulator)
    {
        $this->bufferManipulators[] = $bufferManipulator;

        return $this;
    }

    /**
     * @return \Net\Bazzline\Component\ProxyLogger\BufferManipulator\BufferManipulatorInterface[]
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-11-09
     */
    public function getBufferManipulators()
    {
        return $this->bufferManipulators;
    }

    /**
     * @param array|BufferManipulatorInterface[] $bufferManipulators
     * @return $this
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-11-09
     */
    public function setBufferManipulators(array $bufferManipulators)
    {
        $this->bufferManipulators = $bufferManipulators;

        return $this;
    }
}
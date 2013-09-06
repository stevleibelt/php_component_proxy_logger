<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-09-03 
 */

namespace Net\Bazzline\Component\Logger\BufferManipulation;

/**
 * Class AvoidBufferAwareInterface
 *
 * @package Net\Bazzline\Component\Logger\BufferManipulation
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-09-03
 */
interface AvoidBufferAwareInterface
{
    /**
     * @return null|AvoidBufferInterface
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-09-03
     */
    public function getAvoidBuffer();

    /**
     * @return bool
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-09-03
     */
    public function hasAvoidBuffer();

    /**
     * @param AvoidBufferInterface $avoidBuffer
     * @return $this
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-09-03
     */
    public function setAvoidBuffer(AvoidBufferInterface $avoidBuffer);
}
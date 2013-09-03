<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-09-03 
 */

namespace Net\Bazzline\Component\Logger\BufferManipulation;

/**
 * Class AvoidBufferManipulationAwareInterface
 *
 * @package Net\Bazzline\Component\Logger\BufferManipulation
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-09-03
 */
interface AvoidBufferManipulationAwareInterface
{
    /**
     * @return null|AvoidBufferInterface
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-09-03
     */
    public function getAvoidBufferManipulation();

    /**
     * @return bool
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-09-03
     */
    public function hasAvoidBufferManipulation();

    /**
     * @param AvoidBufferInterface $avoidBuffer
     * @return $this
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-09-03
     */
    public function setAvoidBufferManipulation(AvoidBufferInterface $avoidBuffer);
}
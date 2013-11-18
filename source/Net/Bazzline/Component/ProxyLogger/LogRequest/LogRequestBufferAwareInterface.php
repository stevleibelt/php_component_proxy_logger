<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-11-18 
 */

namespace Net\Bazzline\Component\ProxyLogger\LogRequest;

/**
 * Interface LogRequestBufferAwareInterface
 * @package Net\Bazzline\Component\ProxyLogger\LogRequest
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-11-18
 */
interface LogRequestBufferAwareInterface
{
    /**
     * @return LogRequestBufferInterface
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-11-18
     */
    public function getLogRequestBuffer();

    /**
     * @return bool
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-11-18
     */
    public function hasLogRequestBuffer();

    /**
     * @param LogRequestBufferInterface $buffer
     * @return $this
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-11-18
     */
    public function setLogRequestBuffer(LogRequestBufferInterface $buffer);
} 
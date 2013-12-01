<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 8/27/13
 */

namespace Net\Bazzline\Component\ProxyLogger\LogRequest;

/**
 * Class LogRequestBufferInterface
 *
 * @package Net\Bazzline\Component\ProxyLogger
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-08-27
 */
interface LogRequestBufferInterface
{
    /**
     * @param LogRequestInterface $request
     * @return $this
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-26
     */
    public function add(LogRequestInterface $request);

    /**
     * @param LogRequestInterface $request
     * @return bool
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-26
     */
    public function has(LogRequestInterface $request);

    /**
     * @param LogRequestInterface $request
     * @return $this
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-26
     */
    public function remove(LogRequestInterface $request);

    /**
     * @return $this
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-12-01
     */
    public function removeAll();

    /**
     * @return int
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-27
     */
    public function count();
}
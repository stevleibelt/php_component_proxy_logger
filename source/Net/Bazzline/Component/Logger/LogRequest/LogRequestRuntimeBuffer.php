<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-08-26
 */

namespace Net\Bazzline\Component\Logger\LogRequest;

use SplObjectStorage;
use Net\Bazzline\Component\Logger\LogRequest\LogRequestBufferInterface;
use Net\Bazzline\Component\Logger\LogRequest\LogRequestInterface;

/**
 * Class LogRequestRuntimeBuffer
 *
 * @package Net\Bazzline\Component\Logger
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-08-26
 */
class LogRequestRuntimeBuffer extends SplObjectStorage implements LogRequestBufferInterface
{
    /**
     * @param LogRequestInterface $request
     * @return $this
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-26
     */
    public function add(LogRequestInterface $request)
    {
        parent::attach($request);

        return $this;
    }

    /**
     * @param LogRequestInterface $request
     * @return bool
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-26
     */
    public function has(LogRequestInterface $request)
    {
        return parent::contains($request);
    }

    /**
     * @param LogRequestInterface $request
     * @return $this
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-26
     */
    public function remove(LogRequestInterface $request)
    {
        parent::detach($request);

        return $this;
    }

    /**
     * @return int
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-27
     */
    public function count()
    {
        return parent::count();
    }
}
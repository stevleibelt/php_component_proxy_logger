<?php
/**
 * @author stev leibelt <artodeto@bazzline.net>
 * @since 2013-08-26
 */

namespace Net\Bazzline\Component\ProxyLogger\LogRequest;

use SplObjectStorage;
use Net\Bazzline\Component\ProxyLogger\LogRequest\LogRequestBufferInterface;
use Net\Bazzline\Component\ProxyLogger\LogRequest\LogRequestInterface;

/**
 * Class LogRequestRuntimeBuffer
 *
 * @package Net\Bazzline\Component\ProxyLogger
 * @author stev leibelt <artodeto@bazzline.net>
 * @since 2013-08-26
 */
class LogRequestRuntimeBuffer extends SplObjectStorage implements LogRequestBufferInterface
{
    /**
     * @param LogRequestInterface $request
     * @return $this
     * @author stev leibelt <artodeto@bazzline.net>
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
     * @author stev leibelt <artodeto@bazzline.net>
     * @since 2013-08-26
     */
    public function has(LogRequestInterface $request)
    {
        return parent::contains($request);
    }

    /**
     * @param LogRequestInterface $request
     * @return $this
     * @author stev leibelt <artodeto@bazzline.net>
     * @since 2013-08-26
     */
    public function remove(LogRequestInterface $request)
    {
        parent::detach($request);

        return $this;
    }

    /**
     * @return $this
     * @author stev leibelt <artodeto@bazzline.net>
     * @since 2013-11-01
     */
    public function removeAll()
    {
        parent::removeAll($this);

        return $this;
    }

    /**
     * @return int
     * @author stev leibelt <artodeto@bazzline.net>
     * @since 2013-08-27
     */
    public function count()
    {
        return parent::count();
    }
}
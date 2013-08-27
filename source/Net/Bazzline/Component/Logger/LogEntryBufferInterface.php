<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 8/27/13
 */

namespace Net\Bazzline\Component\Logger;

/**
 * Class LogEntryBufferInterface
 *
 * @package Net\Bazzline\Component\Logger
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-08-27
 */
interface LogEntryBufferInterface
{
    /**
     * @param LogEntryInterface $entry
     * @return $this
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-26
     */
    public function attach(LogEntryInterface $entry);

    /**
     * @param LogEntryInterface $entry
     * @return bool
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-26
     */
    public function contains(LogEntryInterface $entry);

    /**
     * @param LogEntryInterface $entry
     * @return $this
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-26
     */
    public function detach(LogEntryInterface $entry);

    /**
     * @return int
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-27
     */
    public function count();
}
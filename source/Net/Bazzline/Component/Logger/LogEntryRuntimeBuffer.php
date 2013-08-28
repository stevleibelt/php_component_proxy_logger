<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-08-26
 */

namespace Net\Bazzline\Component\Logger;

use SplObjectStorage;

/**
 * Class LogEntryCollection
 *
 * @package Net\Bazzline\Component\Logger
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-08-26
 */
class LogEntryRuntimeBuffer extends SplObjectStorage implements LogEntryBufferInterface
{
    /**
     * @param LogEntryInterface $entry
     * @return $this
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-26
     */
    public function add(LogEntryInterface $entry)
    {
        parent::attach($entry);

        return $this;
    }

    /**
     * @param LogEntryInterface $entry
     * @return bool
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-26
     */
    public function has(LogEntryInterface $entry)
    {
        return parent::contains($entry);
    }

    /**
     * @param LogEntryInterface $entry
     * @return $this
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-26
     */
    public function remove(LogEntryInterface $entry)
    {
        parent::detach($entry);

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
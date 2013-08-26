<?php
/**
 * @author stev leibelt <artodeot@arcor.de>
 * @since 2013-08-26
 */

namespace Net\Bazzline\Component\Logger;

use SplObjectStorage;

/**
 * Class LogEntryCollection
 *
 * @package Net\Bazzline\Component\LogLevelTriggered\ProxyLogger
 * @author stev leibelt <artodeot@arcor.de>
 * @since 2013-08-26
 */
class LogEntryCollection extends SplObjectStorage
{
    /**
     * @param LogEntryInterface $entry
     * @return $this
     * @author stev leibelt <artodeot@arcor.de>
     * @since 2013-08-26
     */
    public function add(LogEntryInterface $entry)
    {
        $this->attach($entry);

        return $this;
    }
}
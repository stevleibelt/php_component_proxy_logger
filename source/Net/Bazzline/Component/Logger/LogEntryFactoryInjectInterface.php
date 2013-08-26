<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-08-26 
 */

namespace Net\Bazzline\Component\Logger;

/**
 * Class LogEntryFactoryInjectInterface
 *
 * @package Net\Bazzline\Component\Logger
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-08-26
 */
interface LogEntryFactoryInjectInterface
{
    /**
     * @param LogEntryFactoryInterface $factory
     * @return $this
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-26
     */
    public function injectLogEntryFactory(LogEntryFactoryInterface $factory);
}
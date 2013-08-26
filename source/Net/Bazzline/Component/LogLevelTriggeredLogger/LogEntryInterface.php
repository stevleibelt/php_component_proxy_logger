<?php
/**
 * @author stev leibelt <artodeot@arcor.de>
 * @since 2013-08-26
 */

namespace Net\Bazzline\Component\LogLevelTriggered\Logger;

/**
 * Class LogEntryInterface
 *
 * @package Net\Bazzline\Component\LogLevelTriggered\Logger
 * @author stev leibelt <artodeot@arcor.de>
 * @since 2013-08-26
 */
interface LogEntryInterface
{
    /**
     * @param mixed $logLevel
     * @param string $message
     * @param array $context
     * @author stev leibelt <artodeot@arcor.de>
     * @since 2013-08-26
     */
    public function __construct($logLevel, $message, array $context = array());

    /**
     * @return string
     * @author stev leibelt <artodeot@arcor.de>
     * @since 2013-08-26
     */
    public function getLevel();

    /**
     * @return string
     * @author stev leibelt <artodeot@arcor.de>
     * @since 2013-08-26
     */
    public function getMessage();

    /**
     * @return mixed
     * @author stev leibelt <artodeot@arcor.de>
     * @since 2013-08-26
     */
    public function getContext();
}
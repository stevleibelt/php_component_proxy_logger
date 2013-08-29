<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-08-26 
 */

use Psr\Log\LogLevel;

return array(
    LogLevel::DEBUG => array(
        LogLevel::INFO,
        LogLevel::NOTICE,
        LogLevel::WARNING,
        LogLevel::ERROR,
        LogLevel::CRITICAL,
        LogLevel::ALERT,
        LogLevel::EMERGENCY
    ),
    LogLevel::INFO => array(
        LogLevel::NOTICE,
        LogLevel::WARNING,
        LogLevel::ERROR,
        LogLevel::CRITICAL,
        LogLevel::ALERT,
        LogLevel::EMERGENCY
    ),
    LogLevel::NOTICE => array(
        LogLevel::WARNING,
        LogLevel::ERROR,
        LogLevel::CRITICAL,
        LogLevel::ALERT,
        LogLevel::EMERGENCY
    ),
    LogLevel::WARNING => array(
        LogLevel::ERROR,
        LogLevel::CRITICAL,
        LogLevel::ALERT,
        LogLevel::EMERGENCY
    ),
    LogLevel::ERROR => array(
        LogLevel::CRITICAL,
        LogLevel::ALERT,
        LogLevel::EMERGENCY
    ),
    LogLevel::CRITICAL => array(
        LogLevel::ALERT,
        LogLevel::EMERGENCY
    ),
    LogLevel::ALERT => array(
        LogLevel::EMERGENCY
    )
);

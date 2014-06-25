<?php
/**
 * @author stev leibelt <artodeto@bazzline.net>
 * @since 2013-08-26
 */

namespace Net\Bazzline\Component\ProxyLogger\LogRequest;

/**
 * Class LogRequestInterface
 *
 * @package Net\Bazzline\Component\ProxyLogger
 * @author stev leibelt <artodeto@bazzline.net>
 * @since 2013-08-26
 */
interface LogRequestInterface
{
    /**
     * @param mixed $logLevel
     * @param string $message
     * @param array $context
     * @author stev leibelt <artodeto@bazzline.net>
     * @since 2013-08-26
     */
    public function __construct($logLevel, $message, array $context = array());

    /**
     * @return mixed
     * @author stev leibelt <artodeto@bazzline.net>
     * @since 2013-08-26
     */
    public function getLevel();

    /**
     * @return string
     * @author stev leibelt <artodeto@bazzline.net>
     * @since 2013-08-26
     */
    public function getMessage();

    /**
     * @return mixed
     * @author stev leibelt <artodeto@bazzline.net>
     * @since 2013-08-26
     */
    public function getContext();
}
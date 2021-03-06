<?php
/**
 * @author stev leibelt <artodeto@bazzline.net>
 * @since 2013-08-26
 */

namespace Net\Bazzline\Component\ProxyLogger\LogRequest;

/**
 * Class LogRequest
 *
 * @package Net\Bazzline\Component\ProxyLogger
 * @author stev leibelt <artodeto@bazzline.net>
 * @since 2013-08-26
 */
class LogRequest implements LogRequestInterface
{
    /**
     * @var mixed
     * @author stev leibelt <artodeto@bazzline.net>
     * @since 2013-08-26
     */
    protected $logLevel;

    /**
     * @var string
     * @author stev leibelt <artodeto@bazzline.net>
     * @since 2013-08-26
     */
    protected $message;

    /**
     * @var array
     * @author stev leibelt <artodeto@bazzline.net>
     * @since 2013-08-26
     */
    protected $context;

    /**
     * @param mixed $logLevel
     * @param string $message
     * @param array $context
     * @author stev leibelt <artodeto@bazzline.net>
     * @since 2013-08-26
     */
    public function __construct($logLevel, $message, array $context = array())
    {
        $this->logLevel = $logLevel;
        $this->message = (string) $message;
        $this->context = (array) $context;
    }

    /**
     * @return mixed
     * @author stev leibelt <artodeto@bazzline.net>
     * @since 2013-08-26
     */
    public function getLevel()
    {
        return $this->logLevel;
    }

    /**
     * @return string
     * @author stev leibelt <artodeto@bazzline.net>
     * @since 2013-08-26
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @return mixed
     * @author stev leibelt <artodeto@bazzline.net>
     * @since 2013-08-26
     */
    public function getContext()
    {
        return $this->context;
    }
}
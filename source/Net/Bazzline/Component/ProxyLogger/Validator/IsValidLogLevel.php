<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-08-30
 */

namespace Net\Bazzline\Component\ProxyLogger\Validator;

use Psr\Log\LogLevel;
use Net\Bazzline\Component\ProxyLogger\Exception\RuntimeException;
use Net\Bazzline\Component\Requirement\IsMetInterface;

/**
 * Class IsValidLogLevel
 *
 * @package Net\Bazzline\Component\ProxyLogger\Validator
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-08-26
 */
class IsValidLogLevel implements IsMetInterface
{
    /**
     * @var mixed
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-28
     */
    protected $logLevel;

    /**
     * @param mixed $logLevel
     * @return $this
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-26
     */
    public function setLogLevel($logLevel)
    {
        $this->logLevel = $logLevel;

        return $this;
    }

    /**
     * Validates if given requirement is met
     *
     * @return boolean
     * @throws RuntimeException
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-06-25
     */
    public function isMet()
    {
        $validLogLevels = array(
            LogLevel::ALERT => true,
            LogLevel::CRITICAL => true,
            LogLevel::DEBUG => true,
            LogLevel::EMERGENCY => true,
            LogLevel::ERROR => true,
            LogLevel::INFO => true,
            LogLevel::NOTICE => true,
            LogLevel::WARNING => true
        );

        if (is_null($this->logLevel)) {
            throw new RuntimeException(
                'no log logLevel provided'
            );
        }

        return (isset($validLogLevels[$this->logLevel]));
    }
}
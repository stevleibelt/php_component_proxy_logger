<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-08-26 
 */

namespace Net\Bazzline\Component\ProxyLogger\Factory;

use Net\Bazzline\Component\ProxyLogger\LogRequest\LogRequest;
use Net\Bazzline\Component\ProxyLogger\Exception\InvalidArgumentException;
use Net\Bazzline\Component\ProxyLogger\Exception\RuntimeException;
use Net\Bazzline\Component\ProxyLogger\Validator\IsValidLogLevel;

/**
 * Class LogRequestFactory
 *
 * @package Net\Bazzline\Component\ProxyLogger
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-08-26
 */
class LogRequestFactory implements LogRequestFactoryInterface
{
    /**
     * @var string
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-29
     */
    protected $logRequestClassName;

    /**
     * @param string $className
     * @return $this
     * @throws InvalidArgumentException
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-29
     */
    public function setLogRequestClassName($className)
    {
        if (!class_exists($className)) {
            $message = 'classname "' . $className . '" does not exist';
            $className = 'Net\\Bazzline\\Component\\ProxyLogger\\LogRequest\\' . $className;
            if (!class_exists($className)) {
                throw new InvalidArgumentException(
                    $message
                );
            }
        }
        $this->logRequestClassName = $className;
    }

    /**
     * @param string $level
     * @param string $message
     * @param array $context
     * @return LogRequest
     * @throws InvalidArgumentException|RuntimeException
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-26
     */
    public function create($level, $message, array $context = array())
    {
        $validator = new isValidLogLevel();

        if (!$validator->setLogLevel($level)->isMet()) {
            throw new InvalidArgumentException(
                'level is not valid'
            );
        }
        if (is_null($this->logRequestClassName)) {
            throw new RuntimeException(
                'no log request class name set'
            );
        }

        return new $this->logRequestClassName($level, $message, $context);
    }
}
<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-08-26 
 */

namespace Net\Bazzline\Component\ProxyLogger\Factory;

use Net\Bazzline\Component\ProxyLogger\LogRequest\LogRequestInterface;
use Net\Bazzline\Component\ProxyLogger\Exception\InvalidArgumentException;
use Net\Bazzline\Component\ProxyLogger\Exception\RuntimeException;
use Net\Bazzline\Component\ProxyLogger\Validator\IsValidLogLevel;

/**
 * Class AbstractLogRequestFactory
 *
 * @package Net\Bazzline\Component\ProxyLogger
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-08-26
 */
abstract class AbstractLogRequestFactory implements LogRequestFactoryInterface
{
    /**
     * @var IsValidLogLevel
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-10-21
     */
    protected $isValidLogLevel;

    /**
     * @param string $level
     * @param string $message
     * @param array $context
     * @return LogRequestInterface
     * @throws InvalidArgumentException|RuntimeException
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-26
     */
    public function create($level, $message, array $context = array())
    {
        if ($this->hasIsValidLogLevel()) {
            $isValidLogLevel = $this->getIsValidLogLevel()
                ->setLogLevel($level)
                ->isMet();

            if (!$isValidLogLevel) {
                throw new InvalidArgumentException(
                    'level is not valid'
                );
            }
        }

        return $this->createNewLogRequestInstance($level, $message, $context);
    }

    /**
     * @return null|IsValidLogLevel
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-09-04
     */
    public function getIsValidLogLevel()
    {
        return $this->isValidLogLevel;
    }

    /**
     * @return bool
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-09-04
     */
    public function hasIsValidLogLevel()
    {
        return (!is_null($this->isValidLogLevel));
    }

    /**
     * @param IsValidLogLevel $isValidLogLevel
     * @return $this
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-09-04
     */
    public function setIsValidLogLevel(IsValidLogLevel $isValidLogLevel)
    {
        $this->isValidLogLevel;

        return $this;
    }

    /**
     * @param string $level
     * @param string $message
     * @param array $context
     * @return LogRequestInterface
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-10-21
     */
    abstract protected function createNewLogRequestInstance($level, $message, array $context = array());
}
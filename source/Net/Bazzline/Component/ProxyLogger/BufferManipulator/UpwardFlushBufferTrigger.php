<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 9/2/13
 */

namespace Net\Bazzline\Component\ProxyLogger\BufferManipulator;

use Net\Bazzline\Component\ProxyLogger\Exception\InvalidArgumentException;
use Psr\Log\LogLevel;

/**
 * Class UpwardFlushBufferTrigger
 *
 * @package Net\Bazzline\Component\ProxyLogger\BufferManipulator
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-09-02
 */
class UpwardFlushBufferTrigger extends AbstractFlushBufferTrigger
{
    /**
     * @var int
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-09-05
     */
    private $logLevelDefaultWeight;

    /**
     * @var int
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-09-05
     */
    private $logLevelMinimumWeight;

    /**
     * @var array
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-09-04
     */
    private $logLevelToWeight;

    /**
     * @param array $logLevelsToPass
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-09-02
     */
    public function __construct(array $logLevelsToPass = array())
    {
        $this->logLevelToWeight = array(
            LogLevel::DEBUG => 0,
            LogLevel::INFO => 1,
            LogLevel::NOTICE => 2,
            LogLevel::WARNING => 3,
            LogLevel::ERROR => 4,
            LogLevel::CRITICAL => 5,
            LogLevel::ALERT => 6,
            LogLevel::EMERGENCY => 7
        );
        $this->logLevelDefaultWeight = $this->mapLogLevelToWeight(LogLevel::DEBUG);
    }

    /**
     * @param mixed $logLevel
     * @return $this
     * @throws \Psr\Log\InvalidArgumentException
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-26
     */
    public function setTriggerTo($logLevel)
    {
        parent::setTriggerTo($logLevel);

        $this->logLevelMinimumWeight = $this->mapLogLevelToWeight($logLevel);

        return $this;
    }

    /**
     * @param string $logLevel
     * @return bool
     * @throws InvalidArgumentException
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-29
     */
    public function triggerBufferFlush($logLevel)
    {
        return ($this->hasTrigger()
            && (($this->trigger == $logLevel)
                || ($this->logLevelMinimumWeight <= $this->mapLogLevelToWeight($logLevel))));
    }

    /**
     * @param $logLevel
     * @return int
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-10-05
     */
    protected function mapLogLevelToWeight($logLevel)
    {
        return (isset($this->logLevelToWeight[$logLevel]))
            ? $this->logLevelToWeight[$logLevel]
            : $this->logLevelDefaultWeight;
    }
}
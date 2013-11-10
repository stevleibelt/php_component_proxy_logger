<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-11-08
 */

namespace Net\Bazzline\Component\ProxyLogger\Event;

use Net\Bazzline\Component\ProxyLogger\LogRequest\LogRequestInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

/**
 * Class ProxyEvent
 *
 * @package Net\Bazzline\Component\ProxyLogger\Event
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-11-08
 */
class ProxyEvent extends Event
{
    const LOG_LOG_REQUEST = 'proxyEvent.logLogRequest';

    /**
     * @var LogRequestInterface
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-11-08
     */
    private $logRequest;

    /**
     * @var array|LoggerInterface[]
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-11-08
     */
    private $loggerCollection = array();

    /**
     * @param null|LogRequestInterface $logRequest
     * @param null|array|LoggerInterface[] $loggerCollection
     * @todo remove this?
     */
    public function __construct(LogRequestInterface $logRequest = null, array $loggerCollection = null)
    {
        $this->setLogRequest($logRequest);
        $this->setLoggerCollection($loggerCollection);
    }

    /**
     * @return array|LoggerInterface[]
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-11-08
     */
    public function getLoggerCollection()
    {
        return $this->loggerCollection;
    }

    /**
     * @return LogRequestInterface
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-11-08
     */
    public function getLogRequest()
    {
        return $this->logRequest;
    }

    /**
     * @param LoggerInterface[] $loggerCollection
     * @return $this
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-11-08
     */
    public function setLoggerCollection($loggerCollection)
    {
        $this->loggerCollection = $loggerCollection;

        return $this;
    }

    /**
     * @param LogRequestInterface $logRequest
     * @return $this
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-11-08
     */
    public function setLogRequest(LogRequestInterface $logRequest)
    {
        $this->logRequest = $logRequest;

        return $this;
    }
}
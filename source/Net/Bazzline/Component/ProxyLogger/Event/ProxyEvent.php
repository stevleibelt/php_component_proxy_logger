<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-11-08
 */

namespace Net\Bazzline\Component\ProxyLogger\Event;

use Net\Bazzline\Component\ProxyLogger\LogRequest\LogRequestInterface;

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
    protected $logRequest;

    /**
     * @var array
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-11-08
     */
    protected $loggerCollection;

    /**
     * @return array
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

    public function setLoggerCollection(array $loggerCollection)
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
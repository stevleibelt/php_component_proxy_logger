<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 9/2/13
 */

namespace Net\Bazzline\Component\Logger\Proxy;

use Net\Bazzline\Component\Logger\Configuration\LogLevelPassThroughInterface;

/**
 * Class PassThroughLogLevelInterface
 *
 * @package Net\Bazzline\Component\Logger\Proxy
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-09-02
 */
interface PassThroughLogLevelInterface
{


    /**
     * @param LogLevelPassThroughInterface $passThrough
     * @return $this
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-09-02
     */
    public function setLogLevelPassThrough(LogLevelPassThroughInterface $passThrough);
}
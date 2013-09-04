<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-09-02 
 */

namespace Net\Bazzline\Component\Logger\BufferManipulation;

use Net\Bazzline\Component\DataType\DataArray;

/**
 * Class AvoidBuffer
 *
 * @package Net\Bazzline\Component\Logger
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-09-02
 */
class AvoidBuffer extends AbstractAvoidBuffer
{
    /**
     * @param array $avoidableLogLevels
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-09-01
     */
    public function __construct(array $avoidableLogLevels = array())
    {
        $this->logLevelsAsKeys = array();

        foreach ($avoidableLogLevels as $avoidableLogLevel) {
            $this->addAvoidableLogLevel($avoidableLogLevel);
        }
    }
}
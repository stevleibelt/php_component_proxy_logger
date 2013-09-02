<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-09-02 
 */

namespace Net\Bazzline\Component\Logger\Configuration;

use Net\Bazzline\Component\DataType\DataArray;

/**
 * Class LogLevelPassThrough
 *
 * @package Net\Bazzline\Component\Logger
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-09-02
 */
class LogLevelPassThrough extends DataArray implements LogLevelPassInterface
{
    /**
     * @var array
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-08-29
     */
    protected $transformedValue;

    /**
     * @param array $logLevelsToPass
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-09-01
     */
    public function __construct(array $logLevelsToPass)
    {
        parent::__construct($logLevelsToPass);

        //validate (via unittest) how often "toArray" is called
        foreach ($this->toArray() as $logLevelToPass) {
            $this->transformedValue[$logLevelToPass] = true;
        }
    }

    /**
     * @param $logLevel
     * @return mixed
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-09-01
     */
    public function letLogLevelPass($logLevel)
    {
        return (isset($this->transformedValue[$logLevel]));
    }
}
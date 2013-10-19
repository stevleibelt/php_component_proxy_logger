<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-10-14
 */

namespace Net\Bazzline\Component\ProxyLogger\Factory;

use Net\Bazzline\Component\ProxyLogger\BufferManipulator\BypassBuffer;
use Net\Bazzline\Component\ProxyLogger\Validator\IsValidLogLevel;

/**
 * Class AbstractBypassBufferFactory
 *
 * @package Net\Bazzline\Component\ProxyLogger\Factory
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-10-14
 */
abstract class AbstractBypassBufferFactory implements BypassBufferFactoryInterface
{
    /**
     * @var array
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-10-14
     */
    protected $logLevelsToBypass;

    /**
     * @return \Net\Bazzline\Component\ProxyLogger\BufferManipulator\BypassBufferInterface
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-10-13
     */
    public function create()
    {
        $bypassBuffer = $this->createNewBypassBufferInstance();

        foreach ($this->logLevelsToBypass as $logLevelToBypass) {
            $bypassBuffer->addBypassForLogLevel($logLevelToBypass);
        }

        return $bypassBuffer;
    }

    /**
     * @param array $logLevelsToBypass
     * @return $this
     * @throws \Net\Bazzline\Component\ProxyLogger\Exception\RuntimeException
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-10-14
     */
    public function setLogLevelsToBypass(array $logLevelsToBypass)
    {
        $validator = new IsValidLogLevel();

        foreach ($logLevelsToBypass as $logLevelToBypass) {
            $validator->setLogLevel($logLevelsToBypass);

            $validator->isMet();
        }

        $this->logLevelsToBypass = $logLevelsToBypass;

        return $this;
    }

    /**
     * @return \Net\Bazzline\Component\ProxyLogger\BufferManipulator\BypassBufferInterface
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-10-20
     */
    abstract protected function createNewBypassBufferInstance();
}
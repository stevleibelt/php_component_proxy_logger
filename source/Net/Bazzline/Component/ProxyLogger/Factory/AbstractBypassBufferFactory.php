<?php
/**
 * @author stev leibelt <artodeto@bazzline.net>
 * @since 2013-10-14
 */

namespace Net\Bazzline\Component\ProxyLogger\Factory;

use Net\Bazzline\Component\ProxyLogger\Validator\IsValidLogLevel;
use Net\Bazzline\Component\ProxyLogger\Exception\RuntimeException;

/**
 * Class AbstractBypassBufferFactory
 *
 * @package Net\Bazzline\Component\ProxyLogger\Factory
 * @author stev leibelt <artodeto@bazzline.net>
 * @since 2013-10-14
 */
abstract class AbstractBypassBufferFactory implements BypassBufferFactoryInterface
{
    /**
     * @var \Net\Bazzline\Component\ProxyLogger\Validator\IsValidLogLevel
     * @author stev leibelt <artodeto@bazzline.net>
     * @since 2013-10-20
     */
    protected $isValidLogLevel;

    /**
     * @var array
     * @author stev leibelt <artodeto@bazzline.net>
     * @since 2013-10-14
     */
    protected $logLevelsToBypass;

    /**
     * @return \Net\Bazzline\Component\ProxyLogger\BufferManipulator\BypassBufferInterface
     * @author stev leibelt <artodeto@bazzline.net>
     * @since 2013-10-13
     */
    public function create()
    {
        $bypassBuffer = $this->createNewBypassBufferInstance();

        if (is_array($this->logLevelsToBypass)) {
            foreach ($this->logLevelsToBypass as $logLevelToBypass) {
                $bypassBuffer->addBypassForLogLevel($logLevelToBypass);
            }
        }

        return $bypassBuffer;
    }

    /**
     * @param array $logLevelsToBypass
     * @return $this
     * @throws \Net\Bazzline\Component\ProxyLogger\Exception\RuntimeException
     * @author stev leibelt <artodeto@bazzline.net>
     * @since 2013-10-14
     */
    public function setLogLevelsToBypass(array $logLevelsToBypass)
    {
        if ($this->hasIsValidLogLevel()) {
            foreach ($logLevelsToBypass as $logLevelToBypass) {
                $this->isValidLogLevel->setLogLevel($logLevelToBypass);

                if (!$this->isValidLogLevel->isMet()) {
                    throw new RuntimeException(
                        'invalid log level provided'
                    );
                }
            }
        }

        $this->logLevelsToBypass = $logLevelsToBypass;

        return $this;
    }

    /**
     * @return null|IsValidLogLevel
     * @author stev leibelt <artodeto@bazzline.net>
     * @since 2013-09-04
     */
    public function getIsValidLogLevel()
    {
        return $this->isValidLogLevel;
    }

    /**
     * @return bool
     * @author stev leibelt <artodeto@bazzline.net>
     * @since 2013-09-04
     */
    public function hasIsValidLogLevel()
    {
        return (!is_null($this->isValidLogLevel));
    }

    /**
     * @param IsValidLogLevel $isValidLogLevel
     * @return $this
     * @author stev leibelt <artodeto@bazzline.net>
     * @since 2013-09-04
     */
    public function setIsValidLogLevel(IsValidLogLevel $isValidLogLevel)
    {
        $this->isValidLogLevel = $isValidLogLevel;

        return $this;
    }

    /**
     * @return \Net\Bazzline\Component\ProxyLogger\BufferManipulator\BypassBufferInterface
     * @author stev leibelt <artodeto@bazzline.net>
     * @since 2013-10-20
     */
    abstract protected function createNewBypassBufferInstance();
}
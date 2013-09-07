<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-09-06 
 */

namespace Test\Net\Bazzline\Component\ProxyLogger\Validator;

use Net\Bazzline\Component\ProxyLogger\Validator\IsValidLogLevel;
use Psr\Log\LogLevel;
use Test\Net\Bazzline\Component\ProxyLogger\TestCase;

/**
 * Class IsValidLogLevelTest
 *
 * @package Test\Net\Bazzline\Component\ProxyLogger\Validator
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-09-06
 */
class IsValidLogLevelTest extends TestCase
{
    /**
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-09-06
     */
    public function testIsMetWithValidLogLevel()
    {
        $isValidLogLevel = $this->getNewIsValidLogLevel();
        $isValidLogLevel->setLogLevel(LogLevel::ALERT);

        $this->assertTrue($isValidLogLevel->isMet());
    }

    /**
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-09-06
     */
    public function testIsMetWithoutValidLogLevel()
    {
        $isValidLogLevel = $this->getNewIsValidLogLevel();
        $isValidLogLevel->setLogLevel('myLogLevel');

        $this->assertFalse($isValidLogLevel->isMet());
    }

    /**
     * @return IsValidLogLevel
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-09-06
     */
    private function getNewIsValidLogLevel()
    {
        return new IsValidLogLevel();
    }
}
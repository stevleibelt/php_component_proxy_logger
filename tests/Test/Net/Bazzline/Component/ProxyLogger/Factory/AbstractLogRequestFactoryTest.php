<?php
/**
 * @author stev leibelt <artodeto@bazzline.net>
 * @since 2013-11-18 
 */

namespace Test\Net\Bazzline\Component\ProxyLogger\Factory;

use Test\Net\Bazzline\Component\ProxyLogger\TestCase;

/**
 * Class AbstractLogRequestFactoryTest
 * @package Test\Net\Bazzline\Component\ProxyLogger\Factory
 * @author stev leibelt <artodeto@bazzline.net>
 * @since 2013-11-18
 */
class AbstractLogRequestFactoryTest extends TestCase
{
    /**
     * @author stev leibelt <artodeto@bazzline.net>
     * @since 2013-11-18
     */
    public function testGetHasSetIsValidLogLevel()
    {
        $factory = $this->getNewAbstractLogRequestFactory();
        $isValidLogLevel = $this->getNewIsValidLogLevelMock();

        $this->assertFalse($factory->hasIsValidLogLevel());
        $this->assertNull($factory->getIsValidLogLevel());

        $factory->setIsValidLogLevel($isValidLogLevel);

        $this->assertTrue($factory->hasIsValidLogLevel());
        $this->assertEquals($isValidLogLevel, $factory->getIsValidLogLevel());
    }
}
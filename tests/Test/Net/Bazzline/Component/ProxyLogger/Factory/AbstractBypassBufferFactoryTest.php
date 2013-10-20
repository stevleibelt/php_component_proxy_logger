<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-10-20
 */

namespace Test\Net\Bazzline\Component\ProxyLogger\Factory;

use Test\Net\Bazzline\Component\ProxyLogger\TestCase;

/**
 * Class AbstractBypassBufferFactoryTest
 *
 * @package Test\Net\Bazzline\Component\ProxyLogger\Factory
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-10-20
 */
class AbstractBypassBufferFactoryTest extends TestCase
{
    /**
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-10-20
     */
    public function testSetInvalidLogLevelsToBypassWithoutIsValidLogLevel()
    {
        $factory = $this->getNewAbstractBypassBufferFactoryMock();

        $this->assertEquals($factory, $factory->setLogLevelsToBypass(array('Foo')));
    }

    /**
     * @expectedException \Net\Bazzline\Component\ProxyLogger\Exception\RuntimeException
     * @expectedExceptionMessage invalid log level provided
     *
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-10-20
     */
    public function testSetInvalidLogLevelsToBypassWithIsValidLogLevel()
    {
        $factory = $this->getNewAbstractBypassBufferFactoryMock();
        $factory->setIsValidLogLevel($this->getNewIsValidLogLevel());
        $factory->setLogLevelsToBypass(array('Foo'));
    }
}
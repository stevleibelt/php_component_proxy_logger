<?php
/**
 * @author stev leibelt <artodeot@arcor.de>
 * @since 2013-08-26
 */

namespace Test\Net\Bazzline\Component\LogLevelTriggered;

use Mockery;
use PHPUnit_Framework_TestCase;

/**
 * Class TestCase
 *
 * @package Test\Net\Bazzline\Component\LogLevelTriggered
 * @author stev leibelt <artodeot@arcor.de>
 * @since 2013-08-26
 */
class TestCase extends PHPUnit_Framework_TestCase
{
    /**
     * @author stev leibelt <artodeot@arcor.de>
     * @since 2013-08-26
     */
    protected function tearDown()
    {
        Mockery::close();
    }
}
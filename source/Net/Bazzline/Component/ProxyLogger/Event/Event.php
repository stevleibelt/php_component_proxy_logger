<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-11-08
 */

namespace Net\Bazzline\Component\ProxyLogger\Event;

use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\EventDispatcher\Event as ParentClass;

/**
 * Class Event
 *
 * @package Net\Bazzline\Component\ProxyLogger\Event
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-11-08
 */
class Event extends ParentClass
{
    /**
     * @param $name
     * @param EventDispatcherInterface $dispatcher
     */
    public function __construct($name, EventDispatcherInterface $dispatcher)
    {
        $this->setName($name);
        $this->setDispatcher($dispatcher);
    }
} 
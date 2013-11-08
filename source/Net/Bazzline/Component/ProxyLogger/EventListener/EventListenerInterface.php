<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-11-08
 */

namespace Net\Bazzline\Component\ProxyLogger\EventListener;

use Net\Bazzline\Component\ProxyLogger\EventDispatcher\EventDispatcher;

/**
 * Interface EventListenerInterface
 *
 * @package Net\Bazzline\Component\ProxyLogger\EventListener
 * @author stev leibelt <artodeto@arcor.de>
 */
interface EventListenerInterface
{
    /**
     * @param EventDispatcher $eventDispatcher
     * @return $this
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-11-08
     */
    public function attach(EventDispatcher $eventDispatcher);

    /**
     * @param EventDispatcher $eventDispatcher
     * @return $this
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-11-08
     */
    public function detach(EventDispatcher $eventDispatcher);
}
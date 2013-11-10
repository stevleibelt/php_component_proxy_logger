<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-11-10
 */

namespace Net\Bazzline\Component\ProxyLogger\EventDispatcher;

/**
 * Interface EventDispatcherDependInterface
 *
 * @package Net\Bazzline\Component\ProxyLogger\EventDispatcher
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-11-10
 */
interface EventDispatcherDependInterface
{
    /**
     * @param EventDispatcherInterface $eventDispatcher
     * @return $this
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-11-10
     */
    public function setEventDispatch(EventDispatcherInterface $eventDispatcher);
} 
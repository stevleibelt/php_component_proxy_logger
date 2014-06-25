<?php
/**
 * @author stev leibelt <artodeto@bazzline.net>
 * @since 2013-11-10
 */

namespace Net\Bazzline\Component\ProxyLogger\EventDispatcher;

/**
 * Interface EventDispatcherDependInterface
 *
 * @package Net\Bazzline\Component\ProxyLogger\EventDispatcher
 * @author stev leibelt <artodeto@bazzline.net>
 * @since 2013-11-10
 */
interface EventDispatcherDependInterface
{
    /**
     * @param EventDispatcherInterface $eventDispatcher
     * @return $this
     * @author stev leibelt <artodeto@bazzline.net>
     * @since 2013-11-10
     */
    public function setEventDispatcher(EventDispatcherInterface $eventDispatcher);
} 
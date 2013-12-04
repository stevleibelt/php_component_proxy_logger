<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 8/28/13
 */

namespace Net\Bazzline\Component\ProxyLogger\Logger;

use Psr\Log\LoggerInterface;

/**
 * Class OutputToConsoleLogger
 *
 * @package Example
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-08-28
 */
class OutputToConsoleLogger extends AbstractLogger implements LoggerInterface
{
    /**
     * Logs with an arbitrary level.
     *
     * @param mixed $level
     * @param string $message
     * @param array $context
     * @return null
     */
    public function log($level, $message, array $context = array())
    {
        echo '[' . time() . '] [' . $level . '] [' . $message . ']' . PHP_EOL;
        if (!empty($context)) {
            foreach ($context as $value) {
                echo "\t" . $value . PHP_EOL;
            }
        }
    }
}
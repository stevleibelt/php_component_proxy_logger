<?php
/**
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-09-04 
 */

namespace Net\Bazzline\Component\Logger\Validator;

/**
 * Class IsValidLogLevelAwareInterface
 *
 * @package Net\Bazzline\Component\Logger\Validator
 * @author stev leibelt <artodeto@arcor.de>
 * @since 2013-09-04
 */
interface IsValidLogLevelAwareInterface
{
    /**
     * @return null|IsValidLogLevel
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-09-04
     */
    public function getIsValidLogLevel();

    /**
     * @return bool
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-09-04
     */
    public function hasIsValidLogLevel();

    /**
     * @param IsValidLogLevel $isValidLogLevel
     * @return $this
     * @author stev leibelt <artodeto@arcor.de>
     * @since 2013-09-04
     */
    public function setIsValidLogLevel(IsValidLogLevel $isValidLogLevel);
}
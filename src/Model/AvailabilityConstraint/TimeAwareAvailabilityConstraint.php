<?php

namespace MoovOne\TimekitPhpSdk\Model\AvailabilityConstraint;

/**
 * Trait TimeAwareAvailabilityConstraint
 * @package MoovOne\TimekitPhpSdk\Model\AvailabilityConstraint
 */
trait TimeAwareAvailabilityConstraint
{
    /**
     * @var string
     */
    private static $timePattern = '/^([0-1]{1}[0-9]|2{1}[0-3]){1}:[0-5]{1}[0-9]{1}$/';

    /**
     * @param string $time
     * @param string|null $propertyName
     * @return bool
     * @throws \InvalidArgumentException
     */
    public static function validateTime(string $time, string $propertyName = null): bool
    {
        if (1 !== preg_match_all(self::$timePattern, $time)) {
            throw new \InvalidArgumentException(sprintf('Bad value for %s parameter. It should respect the H:i format (example: 09:48).', $propertyName));
        }

        return true;
    }
}
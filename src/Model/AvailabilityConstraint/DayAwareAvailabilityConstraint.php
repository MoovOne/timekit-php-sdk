<?php

namespace MoovOne\TimekitPhpSdk\Model\AvailabilityConstraint;

use MoovOne\TimekitPhpSdk\Model\Exception\InvalidAvailabilityConstraintDayException;

/**
 * Trait DayAwareAvailabilityConstraint
 * @package MoovOne\TimekitPhpSdk\Model\AvailabilityConstraint
 */
trait DayAwareAvailabilityConstraint
{
    /**
     * @var string
     */
    public static $monday = 'Monday';

    /**
     * @var string
     */
    public static $tuesday = 'Tuesday';

    /**
     * @var string
     */
    public static $wednesday = 'Wednesday';

    /**
     * @var string
     */
    public static $thursday = 'Thursday';

    /**
     * @var string
     */
    public static $friday = 'Friday';

    /**
     * @var string
     */
    public static $saturday = 'Saturday';

    /**
     * @var string
     */
    public static $sunday = 'Sunday';

    /**
     * @return array
     */
    public static function getAvailableDays(): array
    {
        return [
            self::$monday,
            self::$tuesday,
            self::$wednesday,
            self::$thursday,
            self::$friday,
            self::$saturday,
            self::$sunday,
        ];
    }

    /**
     * @param string $day
     * @param string|null $propertyName
     * @return bool
     * @throws InvalidAvailabilityConstraintDayException
     */
    public static function validateDay(string $day, string $propertyName = null): bool
    {
        if (false === in_array($day, self::getAvailableDays())) {
            throw new InvalidAvailabilityConstraintDayException(sprintf('Bad value for %s parameter. Allowed values are: %s', $propertyName, implode(', ', self::getAvailableDays())));
        }

        return true;
    }
}

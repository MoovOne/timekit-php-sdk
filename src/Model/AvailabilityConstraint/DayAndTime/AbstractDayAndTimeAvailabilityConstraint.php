<?php

namespace MoovOne\TimekitPhpSdk\Model\AvailabilityConstraint\DayAndTime;

use MoovOne\TimekitPhpSdk\Model\AvailabilityConstraint\AvailabilityConstraintInterface;

abstract class AbstractDayAndTimeAvailabilityConstraint implements AvailabilityConstraintInterface
{
    /**
     * @var string
     */
    protected $type;

    /**
     * @var string
     */
    private $day;

    /**
     * @var int
     */
    private $start;

    /**
     * @var int
     */
    private $end;

    public const MONDAY = 'Monday';
    public const TUESDAY = 'Tuesday';
    public const WEDNESDAY = 'Wednesday';
    public const THURSDAY = 'Thursday';
    public const FRIDAY = 'Friday';
    public const SATURDAY = 'Saturday';
    public const SUNDAY = 'Sunday';

    public const AVAILABLE_DAYS = [
        self::MONDAY,
        self::TUESDAY,
        self::WEDNESDAY,
        self::THURSDAY,
        self::FRIDAY,
        self::SATURDAY,
        self::SUNDAY,
    ];

    /**
     * AbstractDayAndTimeAvailabilityConstraint constructor.
     * @param string $day
     * @param int $start
     * @param int $end
     */
    public function __construct(string $day, int $start, int $end)
    {
        if (false === in_array($day, self::AVAILABLE_DAYS)) {
            throw new \InvalidArgumentException('Bad value for $day parameter. allowed values are: '.implode(', ', self::AVAILABLE_DAYS));
        }

        $this->day = $day;
        $this->start = $start;
        $this->end = $end;
    }

    /**
     * @return array
     */
    public function convertToPayloadEntry(): array
    {
        return [
            $this->type => [
                'day' => $this->day,
                'start' => $this->start,
                'end' => $this->end,
            ],
        ];
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @return string
     */
    public function getDay(): string
    {
        return $this->day;
    }

    /**
     * @return int
     */
    public function getStart(): int
    {
        return $this->start;
    }

    /**
     * @return int
     */
    public function getEnd(): int
    {
        return $this->end;
    }
}

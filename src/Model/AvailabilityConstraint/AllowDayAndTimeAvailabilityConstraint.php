<?php

namespace MoovOne\TimekitPhpSdk\Model\AvailabilityConstraint;

class AllowDayAndTimeAvailabilityConstraint implements AvailabilityConstraintInterface
{
    public const TYPE = 'allow_day_and_time';

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

    public function __construct(string $day, int $start, int $end)
    {
        $this->day = $day;
        $this->start = $start;
        $this->end = $end;
    }

    public function convertToPayloadEntry(): array
    {
        return [
            self::TYPE => [
                'day' => $this->day,
                'start' => $this->start,
                'end' => $this->end,
            ],
        ];
    }
}

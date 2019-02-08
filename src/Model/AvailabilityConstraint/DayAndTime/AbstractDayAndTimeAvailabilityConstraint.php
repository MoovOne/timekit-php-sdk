<?php

namespace MoovOne\TimekitPhpSdk\Model\AvailabilityConstraint\DayAndTime;

use MoovOne\TimekitPhpSdk\Model\AvailabilityConstraint\AvailabilityConstraintInterface;
use MoovOne\TimekitPhpSdk\Model\AvailabilityConstraint\DayAwareAvailabilityConstraint;
use MoovOne\TimekitPhpSdk\Model\AvailabilityConstraint\TimeAwareAvailabilityConstraint;

/**
 * Class AbstractDayAndTimeAvailabilityConstraint
 * @package MoovOne\TimekitPhpSdk\Model\AvailabilityConstraint\DayAndTime
 */
abstract class AbstractDayAndTimeAvailabilityConstraint implements AvailabilityConstraintInterface
{
    use DayAwareAvailabilityConstraint;
    use TimeAwareAvailabilityConstraint;

    /**
     * @var string
     */
    protected $type;

    /**
     * @var string
     */
    private $day;

    /**
     * @var string
     */
    private $start;

    /**
     * @var string
     */
    private $end;

    /**
     * AbstractDayAndTimeAvailabilityConstraint constructor.
     * @param string $day
     * @param string $start any H:i formatted time
     * @param string $end any H:i formatted time
     */
    public function __construct(string $day, string $start, string $end)
    {
        $this->validateDay($day, '$day');
        $this->validateTime($start, '$start');
        $this->validateTime($end, '$end');

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
     * @return string
     */
    public function getStart(): string
    {
        return $this->start;
    }

    /**
     * @return string
     */
    public function getEnd(): string
    {
        return $this->end;
    }
}

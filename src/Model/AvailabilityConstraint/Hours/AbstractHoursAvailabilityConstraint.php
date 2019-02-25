<?php

namespace MoovOne\TimekitPhpSdk\Model\AvailabilityConstraint\Hours;

use MoovOne\TimekitPhpSdk\Model\AvailabilityConstraint\AvailabilityConstraintInterface;
use MoovOne\TimekitPhpSdk\Model\AvailabilityConstraint\TimeAwareAvailabilityConstraint;

abstract class AbstractHoursAvailabilityConstraint implements AvailabilityConstraintInterface
{
    use TimeAwareAvailabilityConstraint;

    /**
     * @var string
     */
    protected $type;

    /**
     * @var int
     */
    private $start;

    /**
     * @var int
     */
    private $end;

    /**
     * AbstractHoursAvailabilityConstraint constructor.
     * @param int $start
     * @param int $end
     */
    public function __construct(int $start, int $end)
    {
        $this->validateTime($start, '$start');
        $this->validateTime($end, '$end');

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

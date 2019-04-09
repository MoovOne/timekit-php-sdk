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
     * @var string
     */
    private $start;

    /**
     * @var string
     */
    private $end;

    /**
     * AbstractHoursAvailabilityConstraint constructor.
     * @param string $start
     * @param string $end
     */
    public function __construct(string $start, string $end)
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

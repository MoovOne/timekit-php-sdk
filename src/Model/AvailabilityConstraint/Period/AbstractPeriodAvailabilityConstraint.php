<?php

namespace MoovOne\TimekitPhpSdk\Model\AvailabilityConstraint\Period;

use \DateTime;
use MoovOne\TimekitPhpSdk\Model\AvailabilityConstraint\AvailabilityConstraintInterface;

/**
 * Class AbstractPeriodAvailabilityConstraint
 * @package MoovOne\TimekitPhpSdk\Model\AvailabilityConstraint\Period
 */
abstract class AbstractPeriodAvailabilityConstraint implements AvailabilityConstraintInterface
{
    /**
     * @var string
     */
    protected $type;

    /**
     * @var DateTime
     */
    private $start;

    /**
     * @var DateTime
     */
    private $end;

    /**
     * AbstractAllowPeriodAvailabilityConstraint constructor.
     * @param DateTime $start
     * @param DateTime $end
     */
    public function __construct(DateTime $start, DateTime $end)
    {
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
                'start' => $this->start->format('c'),
                'end' => $this->end->format('c'),
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
     * @return DateTime
     */
    public function getStart(): DateTime
    {
        return $this->start;
    }

    /**
     * @return DateTime
     */
    public function getEnd(): DateTime
    {
        return $this->end;
    }
}

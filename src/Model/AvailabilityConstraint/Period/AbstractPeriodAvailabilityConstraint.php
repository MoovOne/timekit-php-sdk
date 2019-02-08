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
                'start' => $this->start->format('Y-m-d H:i:s'),
                'end' => $this->end->format('Y-m-d H:i:s'),
            ],
        ];
    }
}

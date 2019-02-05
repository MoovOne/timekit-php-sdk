<?php

namespace MoovOne\TimekitPhpSdk\Model\AvailabilityConstraint\Day;

use MoovOne\TimekitPhpSdk\Model\AvailabilityConstraint\AvailabilityConstraintInterface;

abstract class AbstractDayAvailabilityConstraint implements AvailabilityConstraintInterface
{
    /**
     * @var string
     */
    protected $type;

    /**
     * @var string
     */
    protected $day;

    /**
     * AbstractDayAvailabilityConstraint constructor.
     * @param string $day
     */
    public function __construct(string $day)
    {
        $this->day = $day;
    }

    /**
     * @return array
     */
    public function convertToPayloadEntry(): array
    {
        return [
            $this->type => [
                'day' => $this->day,
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
}
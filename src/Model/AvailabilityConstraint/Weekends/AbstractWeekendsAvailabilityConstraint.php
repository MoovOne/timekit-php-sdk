<?php

namespace MoovOne\TimekitPhpSdk\Model\AvailabilityConstraint\Weekends;

class AbstractWeekendsAvailabilityConstraint implements AvailabilityConstraintInterface
{
    /**
     * @var string
     */
    protected $type;

    /**
     * @return array
     */
    public function convertToPayloadEntry(): array
    {
        return [
            $this->type => [],
        ];
    }
}

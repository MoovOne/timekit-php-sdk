<?php

namespace MoovOne\TimekitPhpSdk\Model\AvailabilityConstraint\Weekdays;

use MoovOne\TimekitPhpSdk\Model\AvailabilityConstraint\AvailabilityConstraintInterface;

class AbstractWeekdaysAvailabilityConstraint implements AvailabilityConstraintInterface
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

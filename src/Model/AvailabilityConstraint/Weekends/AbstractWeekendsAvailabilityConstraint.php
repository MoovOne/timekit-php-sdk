<?php

namespace MoovOne\TimekitPhpSdk\Model\AvailabilityConstraint\Weekends;

use MoovOne\TimekitPhpSdk\Model\AvailabilityConstraint\AvailabilityConstraintInterface;

/**
 * Class AbstractWeekendsAvailabilityConstraint
 * @package MoovOne\TimekitPhpSdk\Model\AvailabilityConstraint\Weekends
 */
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

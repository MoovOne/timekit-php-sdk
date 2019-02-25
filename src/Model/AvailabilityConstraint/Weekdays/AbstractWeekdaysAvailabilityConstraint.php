<?php

namespace MoovOne\TimekitPhpSdk\Model\AvailabilityConstraint\Weekdays;

use MoovOne\TimekitPhpSdk\Model\AvailabilityConstraint\AvailabilityConstraintInterface;

/**
 * Class AbstractWeekdaysAvailabilityConstraint
 * @package MoovOne\TimekitPhpSdk\Model\AvailabilityConstraint\Weekdays
 */
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

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }
}

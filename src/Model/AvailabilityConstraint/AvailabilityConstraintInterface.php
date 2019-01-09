<?php

namespace MoovOne\TimekitPhpSdk\Model\AvailabilityConstraint;

interface AvailabilityConstraintInterface
{
    /**
     * Convert an availability constraint for payload usage.
     * Basically, it returns the constraint as an array with its type as the key.
     *
     *
     * @return array
     */
    public function convertToPayloadEntry(): array;
}

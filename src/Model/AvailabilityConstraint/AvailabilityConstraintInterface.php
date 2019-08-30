<?php

namespace MoovOne\TimekitPhpSdk\Model\AvailabilityConstraint;

/**
 * Interface AvailabilityConstraintInterface
 * @package MoovOne\TimekitPhpSdk\Model\AvailabilityConstraint
 */
interface AvailabilityConstraintInterface
{
    /**
     * @return string
     */
    public function getType(): string;

    /**
     * Convert an availability constraint for payload usage.
     * Basically, it returns the constraint as an array with its type as the key.
     *
     * @return array
     */
    public function convertToPayloadEntry(): array;
}

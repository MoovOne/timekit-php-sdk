<?php

require __DIR__.'/../vendor/autoload.php';

ini_set('display_errors', 1);
ini_set('error_reporting', E_ALL);

use \MoovOne\TimekitPhpSdk\Model\AvailabilityConstraint\AvailabilityConstraintInterface;
use \MoovOne\TimekitPhpSdk\Model\AvailabilityConstraint\DayAndTime\AllowDayAndTimeAvailabilityConstraint;
use \MoovOne\TimekitPhpSdk\Model\AvailabilityConstraint\DayAndTime\AbstractDayAndTimeAvailabilityConstraint;

// set availability constraints
$constraints = [
    new AllowDayAndTimeAvailabilityConstraint(AbstractDayAndTimeAvailabilityConstraint::MONDAY, 9, 17),
];

dump($constraints);

foreach ($constraints as $constraint) {
    dump($constraint->getType());
}


$payload = [
    'availability_constraints' => array_map(function (AvailabilityConstraintInterface $constraint) { return $constraint->convertToPayloadEntry(); }, $constraints),
];

dump($payload);
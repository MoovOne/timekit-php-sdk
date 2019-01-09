<?php

namespace MoovOne\TimekitPhpSdk\Model;

class Booking
{
    public const STATE_CONFIRM = 'confirm';
    public const STATE_DECLINE = 'decline';
    public const STATE_CANCEL = 'cancel';
    public const STATE_CANCEL_BY_CUSTOMER = 'cancel_by_customer';

    public static function getAvailableStates()
    {
        return [
            self::STATE_CONFIRM,
            self::STATE_DECLINE,
            self::STATE_CANCEL,
            self::STATE_CANCEL_BY_CUSTOMER,
        ];
    }
}

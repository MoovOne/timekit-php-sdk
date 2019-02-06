<?php

namespace MoovOne\TimekitPhpSdk\Model;

class Availability
{
    public const TYPE_MUTUAL = 'mutual';
    public const TYPE_ROUNDROBIN_RANDOM = 'roundrobin_random';
    public const TYPE_ROUNDROBIN_PRIORITIZED = 'roundrobin_prioritized';

    public const AVAILABLE_TYPES = [
        self::TYPE_MUTUAL,
        self::TYPE_ROUNDROBIN_RANDOM,
        self::TYPE_ROUNDROBIN_PRIORITIZED,
    ];
}
<?php

namespace App\Enums;

final class TaskTicketState
{
    const Open = 0;
    const Pending = 1;
    const Resolved = 2;
    const Closed = 3;

    const MapTo = [
        'open' => self::Open,
        'pending' => self::Pending,
        'resolved' => self::Resolved,
        'closed' => self::Closed,
    ];

    const MapFrom = [
        self::Open => 'open',
        self::Pending => 'pending',
        self::Resolved => 'resolved',
        self::Closed => 'closed',
    ];
}

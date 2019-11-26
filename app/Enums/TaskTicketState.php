<?php

namespace App\Enums;

final class TaskTicketState
{
    const Open = 0;
    const Pending = 1;
    const Resolved = 2;
    const Closed = 3;

    const MapTo = [
        'Open' => self::Open,
        'Pending' => self::Pending,
        'Resolved' => self::Resolved,
        'Closed' => self::Closed,
    ];

    const MapFrom = [
        self::Open => 'Open',
        self::Pending => 'Pending',
        self::Resolved => 'Resolved',
        self::Closed => 'Closed',
    ];
}

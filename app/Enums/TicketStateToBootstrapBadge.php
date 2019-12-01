<?php


namespace App\Enums;


final class TicketStateToBootstrapBadge
{
    const Map = [
        'open' => "badge-warning",
        'pending' => "badge-primary",
        'resolved' => "badge-success",
        'closed' => "badge-danger",
    ];
}

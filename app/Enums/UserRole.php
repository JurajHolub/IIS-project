<?php

namespace App\Enums;

final class UserRole
{
    const Admin = 0;
    const Director = 1;
    const Manager = 2;
    const Employee = 3;
    const Customer = 4;

    const MapTo = [
        'Admin' => self::Admin,
        'Director' => self::Director,
        'Manager' => self::Manager,
        'Employee' => self::Employee,
        'Customer' => self::Customer,
    ];

    const MapFrom = [
        self::Admin => 'Admin',
        self::Director => 'Director',
        self::Manager => 'Manager',
        self::Employee => 'Employee',
        self::Customer => 'Customer',
    ];
}

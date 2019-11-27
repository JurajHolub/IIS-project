<?php

namespace App\Enums;

use http\Client\Curl\User;

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

    static public function admin($role)
    {
        return $role == UserRole::Admin;
    }

    static public function director($role)
    {
        return in_array($role, [UserRole::Director, UserRole::Admin], true);
    }

    static public function manager($role)
    {
        return in_array($role, [UserRole::Manager, UserRole::Director, UserRole::Admin], true);
    }

    static public function employee($role)
    {
        return in_array($role, [UserRole::Employee, UserRole::Manager, UserRole::Director, UserRole::Admin], true);
    }

    static public function customer($role)
    {
        return in_array($role, [USerRole::Customer, UserRole::Employee, UserRole::Manager, UserRole::Director, UserRole::Admin], true);
    }
}

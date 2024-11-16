<?php

namespace App\Enums;

enum RoleEnum
{
    const Admin = 1;
    const Mentor = 2;
    const User = 3;

    public static function getRoleName(int $role): string
    {
        return match ($role) {
            self::Admin => 'Admin',
            self::Mentor => 'Mentor',
            self::User => 'User',
            default => 'User',
        };
    }
}

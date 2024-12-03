<?php

namespace App\Enums;

enum CourseLevelEnum
{
    const Beginner = 1;
    const Intermediate = 2;
    const Advanced = 3;

    public static function getLevelName(int $level): string
    {
        return match ($level) {
            self::Beginner => 'Beginner',
            self::Intermediate => 'Intermediate',
            self::Advanced => 'Advanced',
            default => 'Beginner',
        };
    }
}

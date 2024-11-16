<?php

namespace App\Enums;

enum CourseStatusEnum
{
    const DraftNotPublished = 1;
    const NeedApproval = 2;
    const Published = 3;
    const Rejected = 4;
    const Archived = 5;

    public static function getStatusName(int $status): string
    {
        return match ($status) {
            self::DraftNotPublished => 'Draft Not Published',
            self::NeedApproval => 'Need Approval',
            self::Published => 'Published',
            self::Rejected => 'Rejected',
            self::Archived => 'Archived',
            default => 'Draft Not Published',
        };
    }
}

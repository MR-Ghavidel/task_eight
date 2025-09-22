<?php

namespace App\Enums;

enum PropertyStatus: string
{
    case ACTIVE = 'active';
    case INACTIVE = 'inactive';

    public static function getValues(): array
    {
        return ['active', 'inactive'];
    }
}

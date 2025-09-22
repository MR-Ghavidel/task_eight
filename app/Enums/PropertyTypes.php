<?php

namespace App\Enums;

enum PropertyTypes: string
{
    case APARTMENT = 'apartment';

    case VILLA = 'villa';

    public static function values(): array
    {
        return ['apartment', 'villa'];
    }
}

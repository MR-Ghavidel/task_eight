<?php

namespace App\Enums;

enum PropertySaleTypes: string
{
    case SALE = 'sale';
    case MORTGAGE = 'mortgage';
    case RENT = 'rent';

    public static function values(): array
    {
        return ['sale', 'mortgage', 'rent'];
    }
}

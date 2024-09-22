<?php

namespace App\Enum;

enum CurrencyType: string
{
    case RUB = 'ruble';
    case USD = 'dollar';
    case EUR = 'euro';
}

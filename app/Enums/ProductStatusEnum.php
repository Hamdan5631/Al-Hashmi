<?php

namespace App\Enums;

enum ProductStatusEnum: string
{
    case Active = 'ACTIVE';
    case InActive = 'INACTIVE';
    case Sold = 'SOLD';
    case OUT_OF_STOCK = 'OUT_OF_STOCK';

}

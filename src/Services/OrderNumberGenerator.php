<?php

namespace App\Services;

use Random\RandomException;

class OrderNumberGenerator
{
    /**
     * @throws RandomException
     */
    public static function generateOrderNumber(): string
    {
        return 'S000' . random_int(1, 99999);
    }
}
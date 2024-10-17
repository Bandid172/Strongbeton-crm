<?php

namespace App\Enums;

enum OrderStatus: string
{
    case PENDING = 'pending';
    case CONFIRMED = 'confirmed';
    case PROCESSING = 'processing';
    case ON_HOLD = 'on hold';
    case CANCELLED = 'cancelled';
    case COMPLETED = 'completed';
}
<?php

namespace App\Enums;

enum DeliveryStatus: string {
    case COMPLETED = 'completed';
    case ACTIVE = 'active';
    case PENDING = 'pending';
   
}
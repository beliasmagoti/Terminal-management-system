<?php

namespace App\Enums;

enum TransferStatusType: string {
    case COMPLETED = 'completed';
    case ACTIVE = 'active';
    case PENDING = 'pending';
   
}
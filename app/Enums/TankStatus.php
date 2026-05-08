<?php

namespace App\Enums;

enum TankStatus: string {
    case ACTIVE = 'active';
    case INACTIVE = 'inactive';
    case MAINTENANCE = 'maintenance';
    case OFFLINE = 'offline';
}
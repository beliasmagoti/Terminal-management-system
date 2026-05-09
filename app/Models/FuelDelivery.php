<?php

namespace App\Models;

use App\Enums\DeliveryStatus;
use App\Enums\TankStatus;
use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class FuelDelivery extends Model
{
    use HasUuids;
    protected $fillable = [
        'terminal_id',
        'tank_id',
        'supplier_name',
        'fuel_type',
        'quantity_liters',
        'delivery_reference',
        'delivery_at',
        'delivery_by',
        'status'
    ];

    protected $casts = [
         'quantity_liters'=>'decimal:2',
         'delivery_at'=>'datetime',
         'fuel_type' => TankStatus::class,
         'status'=> DeliveryStatus::class
    ];

    public function terminal () {
        return $this-> belongsTo(Terminal::class);

    }

    public function tank () {
        return $this->belongsTo(Tank::class);
    }
}

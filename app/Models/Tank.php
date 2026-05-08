<?php

namespace App\Models;

use App\Enums\FuelType;
use App\Enums\TankStatus;
use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Model;

class Tank extends Model
{
    use HasUuid;

    protected $fillable = [
        'terminal_id',
        'name',
        'tank_number',
        'fuel_type',
        'capacity_liters',
        'safe_level',
        'critical_level',
        'current_volume',
        'status'
    ];

    protected $casts = [
        'capacity_liters' => 'decimal:2',
        'safe_level' => 'decimal:2',
        'fuel_type'=> FuelType::class,
        'status' => TankStatus::class,
        'current_volume' => 'decimal:2',
    ];

    public function terminal () {
        return $this->belongsTo(Terminal::class);
    }

    public function sensors () {
        return $this->hasMany(Sensor::class);
    }

     public function readings () {
        return $this->hasMany(TankReading::class);
    }
     public function alerts() {
        return $this->hasMany(Alert::class);
    }

    public function deliveries () {
        return $this->hasMany(FuelDelivery::class);
    }
     public function transfers () {
        return $this->hasMany(FuelTransfer::class);
    }

     public function maintenanceRecord() {
        return $this->hasMany(MaintenanceRecords::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TankReading extends Model
{
    protected $fillable = [
        'tank_id',
        'sensor_id',
        'fuel_level_liters',
        'temperature_celsius',
        'pressure_kpa',
        'water_level',
        'density',
        'recorded_at'
    ];

    protected $casts = [
        'fuel_level_liters'=>'decimal:2',
        'temperature_celsius'=>'decimal:2',
        'pressure_kpa'=>'decimal:2',
        'water_level'=>'decimal:2',
        'density'=>'decimal:2',
        'recorded_at'=>'datetime'
    ];
    public function tank () {
        return $this->belongsTo(Tank::class);
    }
      public function sensor () {
        return $this->belongsTo(Sensor::class);
    }
}

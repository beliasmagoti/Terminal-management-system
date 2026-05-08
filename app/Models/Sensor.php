<?php

namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Model;

class Sensor extends Model
{
    use HasUuid;

    protected $fillable = [
        'tank_id',
        'serial_number',
        'sensor_type',
        'manufacturer',
        'installation_date',
        'last_maintenance_date',
        'status'
    ];

    protected $casts = [
        'installation_date'=>'date',
        'last_maintenance_date'=>'date'
    ];

    public function tanks () {
        return $this->belongsTo(Tank::class);
    }

    public function readings () {
        return $this->hasMany(TankReading::class);
    }

    public function deviceToken () {
        return $this->hasOne(DeviceToken::class);
    }

    public function maintenanceRecord() {
        return $this->hasMany(MaintenanceRecords::class);
    }
}

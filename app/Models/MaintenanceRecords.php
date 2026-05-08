<?php

namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Model;

class MaintenanceRecords extends Model
{
    use HasUuid;

    protected $fillable = [
        'tank_id',
        'sensor_id',
        'description',
        'maintenance_date',
        'performed_by'

    ];

    protected $casts = [
         'maintenance_date'=>'datetime',
    ];

    public function sensor () {
        return $this->belongsTo(Sensor::class);
    }

    public function Tank () {
        return $this->belongsTo(Tank::class);
    }
}

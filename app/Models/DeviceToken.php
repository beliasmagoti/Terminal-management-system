<?php

namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class DeviceToken extends Model
{
    use HasUuids;

    protected $fillable = [
        'sensor_id',
        'token',
        'expires_at'
    ];

    protected $casts = [
        'expires_at'=>'datetime'
    ];

    public function sensor () {
        return $this->belongsTo(Sensor::class);
    }
}

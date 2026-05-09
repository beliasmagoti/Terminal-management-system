<?php

namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Terminal extends Model
{
use HasUuids;
    // HasUuid;

    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'name',
        'code',
        'location',
        'status'
    ];


    public function tanks () {
        return $this->hasMany(Tank::class);
    }

     public function users () {
        return $this->hasMany(User::class);
    }

     public function fuelDeliveries () {
        return $this->hasMany(FuelDelivery::class);
    }
}

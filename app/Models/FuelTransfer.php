<?php

namespace App\Models;

use App\Enums\TransferStatusType;
use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class FuelTransfer extends Model
{
    use HasUuids;

    protected $fillable = [
        'from_tank_id',
        'to_tank_id',
        'quantity_liters',
        'transferred_at',
        'transferred_by',
        'status',
        'transfer_type'
    ];

    protected $casts = [
        'quantity_liters'=>'decimal:2',
        'transferred_at'=>'datetime',
        'status'=> TransferStatusType::class
    ];

    public function fromTank() {
        return $this->belongsTo(Tank::class);
    }

    public function toTank () {
        return $this->belongsTo(Tank::class);
    }
}

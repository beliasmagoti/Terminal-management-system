<?php

namespace App\Models;

use App\Traits\HasUuid;
use Illuminate\Database\Eloquent\Model;

class Alert extends Model
{
    use HasUuid;

    protected $fillable = [
        'tank_id',
        'alert_type',
        'severity',
        'message',
        'resolved',
        'triggered_at',
        'resolved_at'
    ];
    protected $casts = [
        'resolved'=>'boolean',
        'triggered_at'=>'datetime',
        'resolved_at'=>'datetime'
    ];

    public function tanks () {
        return $this->belongsTo(Tank::class);
    }
}

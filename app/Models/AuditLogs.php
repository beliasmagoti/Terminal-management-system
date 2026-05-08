<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class AuditLogs extends Model
{
    
    protected $fillable = [
        'user_id',
        'action',
        'entity_type',
        'entity_id',
        'old_values',
        'new_values'
    ];
}
